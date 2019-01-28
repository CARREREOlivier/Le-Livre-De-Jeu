<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesessionsTable extends Migration {

	public function up()
	{
		Schema::create('gamesessions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('game');
			$table->text('description')->nullable();
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('gamesessions');
	}
}