<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFINESTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FINES', function(Blueprint $table)
		{
			$table->string('LOAN_ID', 36)->primary();
			$table->float('FINE_AMT', 10, 0);
			$table->float('PAID', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FINES');
	}

}
