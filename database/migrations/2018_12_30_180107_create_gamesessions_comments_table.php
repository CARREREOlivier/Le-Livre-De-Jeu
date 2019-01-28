<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesessionsCommentsTable extends Migration {

	public function up()
	{
		Schema::create('gamesessions_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('gamesessions_id')->unsigned();
			$table->text('text');
		});
	}

	public function down()
	{
		Schema::drop('gamesessions_comments');
	}
}