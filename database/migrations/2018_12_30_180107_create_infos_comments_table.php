<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfosCommentsTable extends Migration {

	public function up()
	{
		Schema::create('infos_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('info_post_id')->unsigned();
			$table->string('text');
		});
	}

	public function down()
	{
		Schema::drop('infos_comments');
	}
}