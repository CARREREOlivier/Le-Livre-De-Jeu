<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTutorialsCommentsTable extends Migration {

	public function up()
	{
		Schema::create('tutorials_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('tutorial_post_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('text');
		});
	}

	public function down()
	{
		Schema::drop('tutorials_comments');
	}
}