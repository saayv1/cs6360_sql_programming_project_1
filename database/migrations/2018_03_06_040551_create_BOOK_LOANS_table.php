<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBOOKLOANSTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BOOK_LOANS', function(Blueprint $table)
		{
			$table->string('LOAN_ID', 36)->primary();
			$table->string('ISBN10', 10)->index('ISBN10');
			$table->string('CARD_ID', 36)->index('CARD_ID');
			$table->dateTime('DATE_OUT');
			$table->dateTime('DATE_IN')->nullable();
			$table->dateTime('DUE_DATE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('BOOK_LOANS');
	}

}
