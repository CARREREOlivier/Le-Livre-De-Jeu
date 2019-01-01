<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Let's refresh the whole database
        $this->refreshDatabase();

        //Seeding Users table
        $this->seedUsers();

        //Seeding GameSessions table
        $this->seedGameSessions();

        //Seeding GameTurns table
        $this->seedGameTurns();

        // $this->call(UsersTableSeeder::class);
    }

    function refreshDatabase()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:refresh using Artisan
            $this->command->call('migrate:refresh');

            $this->command->line("Data cleared, starting from blank database.");
        }
    }

    /**
     * Seeds users table
     *
     */
    function seedUsers()
    {

        $this->command->line("Seeding Users table");
        //First: Do we want an admin?
        $this->seedAdmin();

        //Ask for number of users to insert
        $numberOfUsers = $this->command->ask('How many blank users do you need ?', 20);
        //Run Factory
        $users = factory(\App\User::class, $numberOfUsers)->create();
        $this->command->info("{$numberOfUsers} created!");


    }

    /**
     *create ONE admin
     */
    function seedAdmin()
    {
        $this->command->confirm('Creating first entry as Admin?');

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'status' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('gabuzomeu'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }

    /**
     *Seeds game sessions
     */
    function seedGameSessions()
    {

        if ($this->command->confirm('Do you want to add gamesessions? This will add users')) {

            $numberOfGameSessions = $this->command->ask('How many game sessions do you need ?', 20);
            $gameSessions = factory(\App\GameSession::class, $numberOfGameSessions)->create();
            $this->command->info("{$numberOfGameSessions} created!");
        } else {
            $this->command->info('exiting seeding');
        }

    }

    function seedGameTurns()
    {

        $this->command->line("inserting gameturns");
        $gameTurnsCount=0;
        $gameSessions = \App\GameSession::all();

        foreach ($gameSessions as $gameSession) {

            $gameTurn = factory(\App\GameTurn::class, 1)->create(["gamesessions_id" => $gameSession->id , "user_id" => $gameSession->user_id]);
            $gameTurnsCount++;
        }

        $this->command->line("$gameTurnsCount game turns inserted ");

    }


}

