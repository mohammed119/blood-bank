<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactDetailsTable extends Migration {

	public function up()
	{
		Schema::create('contact_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 80);
			$table->string('email', 70);
			$table->string('facebook_url', 100);
			$table->string('twitter_url', 100);
			$table->string('youtube_url', 100);
			$table->string('instagram_url', 100);
			$table->string('whatsapp_url', 100);
			$table->string('google_url', 100);
			$table->string('android_app_url', 100);
			$table->string('ios_app_url', 100);
		});
	}

	public function down()
	{
		Schema::drop('contact_details');
	}
}