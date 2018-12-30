<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoriesroleTable extends Migration {

	public function up()
	{
		Schema::create('storiesrole', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned();
			$table->integer('story_id')->unsigned();
			$table->enum('storyrole', array('author', 'co_author', 'authorized', 'forbidden'));
		});
	}

	public function down()
	{
		Schema::drop('storiesrole');
	}
}