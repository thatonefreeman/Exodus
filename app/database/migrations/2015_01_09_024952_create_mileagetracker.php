<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMileagetracker extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            // Creates the users table
            Schema::create('mileage_tracker', function ($table) {
                $table->increments('id');
                $table->string('odometer_start');
                $table->string('odometer_finish');
                $table->string('filling_up');
                $table->string('fuel_level');
                $table->string('price_per_litre');
                $table->string('litres_purchased');
                $table->string('total_fuel_cost');
                $table->string('travel_reason');
                $table->string('travel_origin');
                $table->string('travel_destination');
                $table->string('travel_comments');
                $table->string('mileage_attachement');
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
            Schema::drop('mileage_tracker');
	}

}
