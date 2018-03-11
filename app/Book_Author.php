<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Author extends Model
{
    //

    	protected $table = 'BOOK_AUTHORS';

    public $timestamps=false;

    	
    public function author()
	{
		return $this->belongsToMany(Author::class,'AUTHOR_ID');
		# code...
	}

public function book()
	{
		return $this->belongsToOne(Book::class,'ISBN10');
		# code...
	}
}
