<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameturnsTable extends Migration {

	public function up()
	{
		Schema::create('gameturns', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('gamesessions_id')->unsigned();
			$table->string('title');
			$table->boolean('locked')->default(false);
			$table->text('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('gameturns');
	}
}