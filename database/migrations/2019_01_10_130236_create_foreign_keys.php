<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('gamesessions', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gameturns', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gameturns', function(Blueprint $table) {
			$table->foreign('gamesessions_id')->references('id')->on('gamesessions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gamerole', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gamerole', function(Blueprint $table) {
			$table->foreign('gamesession_id')->references('id')->on('gamesessions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('stories', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('gamesessions_comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gamesessions_comments', function(Blueprint $table) {
			$table->foreign('gamesessions_id')->references('id')->on('gamesessions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('stories_comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('stories_comments', function(Blueprint $table) {
			$table->foreign('story_post_id')->references('id')->on('story_posts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('infos', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('infos_comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('infos_comments', function(Blueprint $table) {
			$table->foreign('info_post_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('story_posts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('story_posts', function(Blueprint $table) {
			$table->foreign('story_id')->references('id')->on('stories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('info_post', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('info_post', function(Blueprint $table) {
			$table->foreign('info_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tutorials', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tutorial_post', function(Blueprint $table) {
			$table->foreign('tutorial_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tutorial_post', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tutorials_comments', function(Blueprint $table) {
			$table->foreign('tutorial_post_id')->references('id')->on('tutorial_post')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tutorials_comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('uploads', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('turnorders', function(Blueprint $table) {
			$table->foreign('gameturn_id')->references('id')->on('gameturns')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('turnorders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('turncomments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('turncomments', function(Blueprint $table) {
			$table->foreign('gameturn_id')->references('id')->on('gameturns')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('gamesessions', function(Blueprint $table) {
			$table->dropForeign('gamesessions_user_id_foreign');
		});
		Schema::table('gameturns', function(Blueprint $table) {
			$table->dropForeign('gameturns_user_id_foreign');
		});
		Schema::table('gameturns', function(Blueprint $table) {
			$table->dropForeign('gameturns_gamesessions_id_foreign');
		});
		Schema::table('gamerole', function(Blueprint $table) {
			$table->dropForeign('gamerole_user_id_foreign');
		});
		Schema::table('gamerole', function(Blueprint $table) {
			$table->dropForeign('gamerole_gamesession_id_foreign');
		});
		Schema::table('stories', function(Blueprint $table) {
			$table->dropForeign('stories_user_id_foreign');
		});

		Schema::table('gamesessions_comments', function(Blueprint $table) {
			$table->dropForeign('gamesessions_comments_user_id_foreign');
		});
		Schema::table('gamesessions_comments', function(Blueprint $table) {
			$table->dropForeign('gamesessions_comments_gamesessions_id_foreign');
		});
		Schema::table('stories_comments', function(Blueprint $table) {
			$table->dropForeign('stories_comments_user_id_foreign');
		});
		Schema::table('stories_comments', function(Blueprint $table) {
			$table->dropForeign('stories_comments_story_post_id_foreign');
		});
		Schema::table('infos', function(Blueprint $table) {
			$table->dropForeign('infos_user_id_foreign');
		});
		Schema::table('infos_comments', function(Blueprint $table) {
			$table->dropForeign('infos_comments_user_id_foreign');
		});
		Schema::table('infos_comments', function(Blueprint $table) {
			$table->dropForeign('infos_comments_info_post_id_foreign');
		});
		Schema::table('story_posts', function(Blueprint $table) {
			$table->dropForeign('story_posts_user_id_foreign');
		});
		Schema::table('story_posts', function(Blueprint $table) {
			$table->dropForeign('story_posts_story_id_foreign');
		});
		Schema::table('info_post', function(Blueprint $table) {
			$table->dropForeign('info_post_user_id_foreign');
		});
		Schema::table('info_post', function(Blueprint $table) {
			$table->dropForeign('info_post_info_id_foreign');
		});
		Schema::table('tutorials', function(Blueprint $table) {
			$table->dropForeign('tutorials_user_id_foreign');
		});
		Schema::table('tutorial_post', function(Blueprint $table) {
			$table->dropForeign('tutorial_post_tutorial_id_foreign');
		});
		Schema::table('tutorial_post', function(Blueprint $table) {
			$table->dropForeign('tutorial_post_user_id_foreign');
		});
		Schema::table('tutorials_comments', function(Blueprint $table) {
			$table->dropForeign('tutorials_comments_tutorial_post_id_foreign');
		});
		Schema::table('tutorials_comments', function(Blueprint $table) {
			$table->dropForeign('tutorials_comments_user_id_foreign');
		});
		Schema::table('uploads', function(Blueprint $table) {
			$table->dropForeign('uploads_user_id_foreign');
		});
		Schema::table('turnorders', function(Blueprint $table) {
			$table->dropForeign('turnorders_gameturn_id_foreign');
		});
		Schema::table('turnorders', function(Blueprint $table) {
			$table->dropForeign('turnorders_user_id_foreign');
		});
		Schema::table('turncomments', function(Blueprint $table) {
			$table->dropForeign('turncomments_user_id_foreign');
		});
		Schema::table('turncomments', function(Blueprint $table) {
			$table->dropForeign('turncomments_gameturn_id_foreign');
		});
	}
}