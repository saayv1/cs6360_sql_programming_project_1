<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Book_Loan;
use App\Fine;
use App\Borrower;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;

class FineController extends Controller
{
    //

    public function displayFines()
    {
    	$list_of_all_fines = DB::select('SELECT BORROWER.CARD_ID, BORROWER.FNAME, BORROWER.LNAME,SUM(FINES.FINE_AMT) AS TOTAL_FINE FROM FINES,BOOK_LOANS,BORROWER WHERE FINES.LOAN_ID = BOOK_LOANS.LOAN_ID AND BORROWER.CARD_ID = BOOK_LOANS.CARD_ID AND FINES.PAID = FALSE GROUP BY BORROWER.CARD_ID HAVING TOTAL_FINE>0;');

    	return view('fine')->with('list_of_all_fines',$list_of_all_fines);
    }

    public function updateFines()
    {
    	$now = date("Y-m-d H:i:s");
    	$list_of_all_unpaid_fines_where_book_is_not_returned = DB::select("SELECT * FROM FINES,BOOK_LOANS WHERE FINES.LOAN_ID = BOOK_LOANS.LOAN_ID AND FINES.PAID=FALSE AND DATE_IN IS NULL AND DATEDIFF(NOW(),BOOK_LOANS.DUE_DATE)>1");


    	$list_of_all_unpaid_fines_where_book_is_returned = DB::select('SELECT * FROM FINES,BOOK_LOANS WHERE FINES.LOAN_ID = BOOK_LOANS.LOAN_ID AND FINES.PAID=FALSE AND DATE_IN IS NOT NULL AND DATEDIFF(BOOK_LOANS.DATE_IN,BOOK_LOANS.DUE_DATE)>1');

    	foreach ($list_of_all_unpaid_fines_where_book_is_returned as $f) {
    		$difference = Carbon::parse($f->DATE_IN)->diffInDays(Carbon::parse($f->DUE_DATE)) ;
    		$fine = $difference * 0.25;
    		$fine_to_be_updated=Fine::where('LOAN_ID','=',$f->LOAN_ID)->first();
    		$fine_to_be_updated->FINE_AMT = $fine;
    		$fine_to_be_updated->save();
    	}

    	foreach ($list_of_all_unpaid_fines_where_book_is_not_returned as $f) {
    		$difference = Carbon::now()->diffInDays(Carbon::parse($f->DUE_DATE));
    		$fine = $difference * 0.25;
    		$fine_to_be_updated=Fine::where('LOAN_ID','=',$f->LOAN_ID)->first();
    		$fine_to_be_updated->FINE_AMT = $fine;
    		$fine_to_be_updated->save();
    	}

    	return redirect('fine');
    }

    public function payment()
    {
    	$card_id = request('card_id');
    	$person = Borrower::where('CARD_ID','=',$card_id)->first();
    	$loans_of_person = Book_Loan::where('CARD_ID','=',$card_id)->get();
    	foreach ($loans_of_person as $l) {
    	if($l->DATE_IN==NULL)
    	{
		return redirect('fine')->withErrors('The book has not been returned');    	
    	}
    	}
    	
    	foreach ($loans_of_person as $l) {
    		$fine=Fine::where('LOAN_ID','=',$l->LOAN_ID)->first();

    		if($fine->PAID==false)
    		{
    			$fine->PAID = true;
    			$fine->save();
    		}
    	}
		return redirect('fine')->withMessage('The fine has been paid');    	
    }

}
