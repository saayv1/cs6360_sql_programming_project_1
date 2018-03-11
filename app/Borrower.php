<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    //


    protected $table = 'BORROWER';

    public $timestamps=false;
    public $incrementing = false;

    public function book_loan()
	{
		return $this->hasMany(Book_Loan::class,'CARD_ID');
	}

}
