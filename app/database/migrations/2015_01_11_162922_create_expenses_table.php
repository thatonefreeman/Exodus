<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('expenses', function ($table) {
                $table->increments('id');
                $table->string('expense_category_id');
                $table->string('expense_location');
                $table->string('expense_company_name');
                $table->string('expense_datetime');
                $table->string('expense_amount');
                $table->string('expense_tax');
                $table->enum('expense_payment_type', array('Cash', 'Credit Card', 'eTransfer', 'Debit Card', 'Gift Card', 'Store Credit', 'Other'));
                $table->string('expense_company_bn');
                $table->string('expense_comments');
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
		Schema::drop('expenses');
	}

}
