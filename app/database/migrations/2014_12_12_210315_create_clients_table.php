<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('clients', function($table)
            {
                $table->increments('id');
                $table->string('client_name', 128);
                $table->string('client_company_name', 128);
                $table->int('authorized_work');
                $table->string('client_number', 128);
                $table->string('client_address', 128);
                $table->string('client_email', 128);
                $table->text('client_notes');
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
		Schema::drop('clients');
	}

}
