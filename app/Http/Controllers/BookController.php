<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Fine;
use App\Author;
use App\Book_Author;
use App\Temp;
use App\Borrower;
use App\Book_Loan;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{

    //

    public function index()
    {
        $v2 = DB::table('temp')->select('ISBN10','AUTHOR','TITLE','AVAILABILITY')->orderBy('ISBN10')->paginate(100);
        return view('index')->with('var', $v2);
    }


    public function searchValidate(){
    	$search=request('selection');

        if(empty($search))
        {
            return redirect('main');
        }
        
        else
        {
            $tokens = explode(' ', $search);

            $a1=DB::table('temp')
            ->select('temp.ISBN10','AUTHOR','TITLE','AVAILABILITY')
            ->where('temp.ISBN10','not like','%%');

            foreach($tokens as $t)
            {
                $a1=$a1->orWhere('temp.ISBN10','like','%'.$t.'%')
                ->orWhere('AUTHOR','like','%'.$t.'%')
                ->orWhere('TITLE','like','%'.$t.'%');
            }
            $a1=$a1->paginate(100);
            if(empty($a1)){
                return redirect('main');
            }
            return view('index')->with('var', $a1);
        }
    }

    public function checkOut(){
        $book_details = request('book_details');

        $book = DB::table('temp')->where('ISBN10','=',$book_details)->first();
        if(!$book->AVAILABILITY)
        {
            return Redirect::back()->withErrors('The book is unavailable');
        }

        return view('checkout')->with('var',$book);
    }

    public function checkOutComplete(){
        $card_number = request('card_id');
        $book_details = request('book_details');
        $borrower = Borrower::where('CARD_ID','=',$card_number)->first();
        if(empty($borrower)||$borrower=='[]')
        {
           return Redirect::back()->withErrors('Incorrect card_number');
       }

        //$loancheck = Book_Loan::where('ISBN10','=',$book_details)->where('DATE_IN','=',NULL);
        $borrower_book_lease_count = Book_Loan::where('CARD_ID','=',$borrower->CARD_ID)->where('DATE_IN','=',NULL)->get()->count();
        if($borrower_book_lease_count>3)
        {
            return redirect('main')->withErrors('The user has borrowed more than 3 books');
        }
        /*
        if(empty($loancheck)){
            return redirect('foo');
        }
        */
        $loan= new Book_Loan();
        $loan->LOAN_ID = uniqid();
        $book = Temp::where('ISBN10','=',$book_details)->first();
        $loan->ISBN10 = $book_details;
        $loan->CARD_ID = $borrower->CARD_ID;
        $loan->DUE_DATE = date("Y-m-d", time() + 86400 *14);
        $loan->DATE_OUT = date("Y-m-d");
        $book->AVAILABILITY=false;
        $book->save();
        $loan->save();


        $fine = new Fine();
        $fine->LOAN_ID = $loan->LOAN_ID;
        $fine->FINE_AMT = 0.0;
        $fine->paid = false;
        $fine->save();

       return redirect('main')->withMessage('Successfully checked out the book. The loan id is '.$loan->LOAN_ID);
   }


   public function checkInIndex(){

        $var = DB::table('BOOK_LOANS')
        ->join('BORROWER','BOOK_LOANS.CARD_ID','=','BORROWER.CARD_ID')
        ->select()
        ->where('BOOK_LOANS.DATE_IN','=',NULL)
        ->get();

       return view('checkin')->with('var', $var);
   }


   public function checkInSearchValidate(){
        $search=request('selection');

        if(empty($search))
        {
            return redirect('check_in')->withErrors('Empty search query');
        }
        
        else
        {
            $tokens = explode(' ', $search);
            $query=DB::table('BORROWER')
            ->join('BOOK_LOANS','BOOK_LOANS.CARD_ID','=','BORROWER.CARD_ID')
            ->select()
            ->whereNULL('BOOK_LOANS.DATE_IN');
            foreach($tokens as $t)
            {

                $query->where(function($q) use($t)
            {
                $q->where('BORROWER.CARD_ID','like','%'.$t.'%')
                ->orWhere('BOOK_LOANS.ISBN10','like','%'.$t.'%')
                ->orWhere('BORROWER.FNAME','like','%'.$t.'%')
                ->orWhere('BORROWER.LNAME','like','%'.$t.'%');
            });
                
            }
            $query=$query->get();
           
            if(empty($query)||$query=='[]'){
                return redirect('check_in')->withErrors('No records found');
            }
            return view('checkin')->with('var', $query);

        }
    }


    public function checkInComplete(){
        $loan_id = request('loan_id');
        $loan = Book_Loan::where('LOAN_ID','=',$loan_id)->first();
        $loan->DATE_IN = date("Y-m-d");
        $book = Temp::where('ISBN10','=',$loan->ISBN10)->first();
        $book->AVAILABILITY = true;
        $book->save();
        $loan->save();
       return redirect('main')->withMessage('Successfully checked in the book.');
   }



}
