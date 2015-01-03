<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('ticket_reply', function($table){
                $table->increments('id');
                $table->string('ticket_reply_subject', 128);
                $table->string('ticket_reply_body', 128);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('ticket_reply');
	}

}
