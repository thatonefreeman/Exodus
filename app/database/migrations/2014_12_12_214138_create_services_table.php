<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('services', function(Blueprint $table) {
                    $table->increments('id');
                    $table->string('service_name');
                    $table->text('service_description');
                    $table->decimal('price', 5, 2);
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
		Schema::drop('services');
	}

}
