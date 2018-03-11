<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFINALBOOKAUTHTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FINALBOOKAUTH', function(Blueprint $table)
		{
			$table->string('ISBN10', 10);
			$table->string('AUTHOR', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FINALBOOKAUTH');
	}

}
