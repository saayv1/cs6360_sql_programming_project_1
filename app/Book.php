<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
	
	protected $table = 'BOOK';

	protected $primaryKey = 'ISBN10';

	public $incrementing = false;

	    public $timestamps=false;



	public function book_author()
	{
		return $this->hasMany(Book_Author::class,'ISBN10');
		# code...
	}

	public function book_loan()
	{
		return $this->hasMany(Book_Loan::class,'ISBN10');
	}
 
}
