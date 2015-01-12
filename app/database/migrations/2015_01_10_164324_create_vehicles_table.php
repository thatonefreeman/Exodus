<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('vehicles', function ($table) {
                $table->increments('id');
                $table->string('vehicle_owner');
                $table->string('vehicle_license_plate');
                $table->string('vehicle_make_model');
                $table->string('vehicle_year');
                $table->string('vehicle_attachment');
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehicles');
	}

}
