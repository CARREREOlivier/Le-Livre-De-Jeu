<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoriesTable extends Migration {

	public function up()
	{
		Schema::create('stories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('description');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('stories');
	}
}