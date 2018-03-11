<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBOOKAUTHORSTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BOOK_AUTHORS', function(Blueprint $table)
		{
			$table->string('AUTHOR_ID', 36);
			$table->string('ISBN10', 10)->index('ISBN10');
			$table->primary(['AUTHOR_ID','ISBN10']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('BOOK_AUTHORS');
	}

}
