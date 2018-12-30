<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfoPostTable extends Migration {

	public function up()
	{
		Schema::create('info_post', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned();
			$table->integer('info_id')->unsigned();
			$table->text('text');
		});
	}

	public function down()
	{
		Schema::drop('info_post');
	}
}