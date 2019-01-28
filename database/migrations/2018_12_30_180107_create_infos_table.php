<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfosTable extends Migration {

	public function up()
	{
		Schema::create('infos', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('summary')->nullable();
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('infos');
	}
}