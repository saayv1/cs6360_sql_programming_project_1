<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBORROWERTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BORROWER', function(Blueprint $table)
		{
			$table->string('SSN', 11)->unique('SSN');
			$table->string('FNAME', 20);
			$table->string('LNAME', 20);
			$table->string('EMAIL', 50)->nullable();
			$table->string('ADDRESS', 50);
			$table->string('CITY', 15);
			$table->string('STATE', 2);
			$table->string('PHONE', 15)->nullable();
			$table->string('CARD_ID', 36)->primary();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('BORROWER');
	}

}
