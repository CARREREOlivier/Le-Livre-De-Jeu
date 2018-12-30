<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTutorialsTable extends Migration {

	public function up()
	{
		Schema::create('tutorials', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('tutorials');
	}
}