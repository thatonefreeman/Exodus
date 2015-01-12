<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpensesPaymentTypeColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expenses', function($table)
                {
                   $table->enum('expense_payment_type', array('Cash', 'Credit Card', 'eTransfer', 'Debit Card', 'Gift Card', 'Store Credit', 'Other')); 
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('expenses', function($table)
            {
               $table->dropColumn('expenses_payment_type');
            });		
	}

}
