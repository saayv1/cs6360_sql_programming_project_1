<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temp', function(Blueprint $table)
		{
			$table->string('ISBN10', 11);
			$table->string('ISBN13', 14);
			$table->string('TITLE', 200);
			$table->string('AUTHOR', 50);
			$table->text('COVER', 65535);
			$table->string('PUBLISHER', 50);
			$table->string('PAGES', 4);
			$table->boolean('AVAILABILITY')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('temp');
	}

}
