<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('tickets', function($table){
                $table->increments('id');
                $table->string('ticket_subject', 128);
                $table->string('ticket_body', 128);
                $table->string('ticket_client_id', 128);
                $table->string('ticket_class_id', 128);
                $table->enum('status', array('Open', 'Closed', 'Resolved', 'Other', 'Pending'));
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('tickets');
	}

}
