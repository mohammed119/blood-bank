<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->string('name', 80);
			$table->integer('age');
			$table->integer('blood_type_id')->unsigned();
			$table->bigInteger('bags_number');
			$table->string('hospital_name', 100);
			$table->integer('city_id')->unsigned();
			$table->string('phone', 50);
			$table->text('details');
			$table->float('latitude', 10,8);
			$table->float('longitude', 10,8);
			$table->string('hospital_address');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}