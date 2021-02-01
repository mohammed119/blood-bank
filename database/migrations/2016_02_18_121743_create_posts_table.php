<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id')->unsigned()->nullable(true);
			$table->string('title', 80);
			$table->text('text');
			$table->string('image', 80);
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}