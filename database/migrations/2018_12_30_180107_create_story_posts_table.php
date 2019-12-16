<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoryPostsTable extends Migration {

	public function up()
	{
		Schema::create('story_posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('story_id')->unsigned();
			$table->integer('author')->unsigned();
            $table->integer('co_author')->unsigned();
            $table->integer('visible_by')->unsigned();
			$table->longText('text');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('story_posts');
	}
}