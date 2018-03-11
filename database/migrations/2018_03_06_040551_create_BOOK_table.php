<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBOOKTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BOOK', function(Blueprint $table)
		{
			$table->string('ISBN10', 10)->primary();
			$table->string('ISBN13', 13)->nullable();
			$table->string('TITLE', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('BOOK');
	}

}
