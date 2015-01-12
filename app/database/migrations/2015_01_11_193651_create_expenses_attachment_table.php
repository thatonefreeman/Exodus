<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesAttachmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('expenses_attachment', function ($table) {
                $table->increments('id');
                $table->string('expense_attachment_file');
                $table->string('expenses_id');
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
		Schema::drop('expenses_attachment');
	}

}
