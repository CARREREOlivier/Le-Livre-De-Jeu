<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTutorialPostTable extends Migration {

	public function up()
	{
		Schema::create('tutorial_post', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tutorial_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->longText('text');
		});
	}

	public function down()
	{
		Schema::drop('tutorial_post');
	}
}