<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Loan extends Model
{

	protected $table = 'BOOK_LOANS';

	protected $primaryKey = 'LOAN_ID';

    public $timestamps=false;

    public $incrementing = false;

	public function fine()
	{
		return $this->hasOne(Fine::class,'LOAN_ID');
		# code...
	}

	public function book()
	{
		return $this->belongsToOne(Book::class,'ISBN10');
		# code...
	}

	public function borrower()
	{
		return $this->belongsToOne(Borrower::class,'CARD_ID');
		# code...
	}
    //
}
