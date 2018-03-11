<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBOOKAUTHORSTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('BOOK_AUTHORS', function(Blueprint $table)
		{
			$table->foreign('AUTHOR_ID', 'book_authors_ibfk_1')->references('AUTHOR_ID')->on('AUTHORS')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('BOOK_AUTHORS', function(Blueprint $table)
		{
			$table->dropForeign('book_authors_ibfk_1');
		});
	}

}
