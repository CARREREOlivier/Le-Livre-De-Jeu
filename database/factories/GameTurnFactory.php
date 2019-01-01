<?php

use Faker\Generator as Faker;

$factory->define(\App\GameTurn::class, function (Faker $faker) {
    return [

        'title' => $faker->sentence(2),
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => 1,
        'gamesessions_id' => 1,
        'description' => $faker->paragraph(3),


    ];
});

/*
$table->increments('id');
$table->timestamps();
$table->softDeletes();
$table->integer('user_id')->unsigned();
$table->integer('gamesessions_id')->unsigned();
$table->string('title');
$table->text('description')->nullable();
*/