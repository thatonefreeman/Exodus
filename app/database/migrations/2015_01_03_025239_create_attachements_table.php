<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachements', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('client_id');
                        $table->text('attachment_name');
                        $table->text('attachment_description');
                        $table->text('file_location');
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
		Schema::drop('attachements');
	}

}
