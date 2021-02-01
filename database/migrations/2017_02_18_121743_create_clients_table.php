<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 20)->unique();
			$table->string('password');
//			$table->string('remember_me');
			$table->string('name', 50);
			$table->string('email', 100)->unique();
			$table->date('birth_date');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_date_donate');
			$table->integer('city_id')->unsigned();
//			$table->string('validation_code');
            $table->string('pin_code')->nullable();
			$table->string('api_token',60)->unique()->nullable();
			$table->boolean('is_active')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}