<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameroleTable extends Migration {

	public function up()
	{
		Schema::create('gamerole', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned();
			$table->integer('gamesession_id')->unsigned();
			$table->enum('gamerole', array('GameMaster', 'GameParticipant', 'Spectator'));
		});
	}

	public function down()
	{
		Schema::drop('gamerole');
	}
}