<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTurncommentsTable extends Migration {

	public function up()
	{
		Schema::create('turncomments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('gameturn_id')->unsigned();
			$table->text('text');
		});
	}

	public function down()
	{
		Schema::drop('turncomments');
	}
}