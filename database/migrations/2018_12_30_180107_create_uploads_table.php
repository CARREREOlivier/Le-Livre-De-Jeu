<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUploadsTable extends Migration {

	public function up()
	{
		Schema::create('uploads', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->text('filename');
			$table->text('resized_name');
			$table->text('original_name');
			$table->integer('user_id')->unsigned();
			$table->enum('category', array('gameturns', 'story_post', 'info_post', 'uncategorized', 'tutorial_post'));
			$table->integer('entity_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('uploads');
	}
}