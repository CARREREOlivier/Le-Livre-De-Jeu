<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoriesCommentsTable extends Migration {

	public function up()
	{
		Schema::create('stories_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('story_post_id')->unsigned();
			$table->text('text')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('stories_comments');
	}
}