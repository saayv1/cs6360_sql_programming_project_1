<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{

    public $timestamps=false;

    protected $primaryKey = 'LOAN_ID';

	public $incrementing = false;


    //
    public function Book_Loan()
	{
		return $this->hasOne(Book_Loan::class,'LOAN_ID');
		# code...
	}
}
