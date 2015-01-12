<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('reminders', function ($table) {
                $table->increments('id');
                $table->string('reminder_label');
                $table->string('reminder_body');
                $table->string('reminder_alarm');
                $table->string('reminder_method');
                $table->string('user_id');
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
            Schema::drop('reminders');
	}

}
