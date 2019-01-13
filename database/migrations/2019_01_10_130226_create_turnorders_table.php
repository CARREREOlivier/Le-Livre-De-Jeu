<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTurnordersTable extends Migration {

	public function up()
	{
		Schema::create('turnorders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('gameturn_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('message');
		});
	}

	public function down()
	{
		Schema::drop('turnorders');
	}
}