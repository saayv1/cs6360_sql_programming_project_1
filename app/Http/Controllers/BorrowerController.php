<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Borrower;
use Illuminate\Support\Facades\Redirect;


class BorrowerController extends Controller
{
    //

    public function index()
    {
    	return view('borrowerEntry');
    }

    public function create()
    {

    	  $rules = array(                                                             
            'fname'           => 'required',                                       
            'lname'           => 'required|alpha',                                 
            'ssn'         	  => 'required|between:10,14',     
            'address'         => 'required',
            'email'           => 'required|email',     
            'city'            => 'required|alpha',  
     		'state'           => 'required|alpha|between:2,2',  
        );
        $validator = Validator::make(Input::all(), $rules);   

        if ($validator->fails()) {
            $messages = $validator->messages();

            return Redirect::to('create_borrower')
                ->withErrors($validator)->withInput();                                           //In case of any failure, the page redirects to the same entry page with data reset//
        }
        else{

            $borrower = new Borrower();                                     

            $borrower->FNAME    = Input::get('fname');                         //get name from the form//
            $borrower->LNAME   = Input::get('lname');                        

            $borrower->SSN   = Input::get('ssn');   

            $borrower->ADDRESS   = Input::get('address');   

            $borrower->EMAIL   = Input::get('email');   

            $borrower->CITY   = Input::get('city');   

            $borrower->STATE   = Input::get('state');    

            $borrower->PHONE   = Input::get('phone');    

            $borrower_ssn = Borrower::where('SSN','=', $borrower->SSN)->get();

            if($borrower_ssn != '[]'){
            	return Redirect::to('create_borrower')->withErrors("Could not create borrower. This particular ssn exists ");
            }
            
            else{
                $borrower->save();
            	return Redirect::to('create_borrower')->withMessage("Created the borrower successfully");
            }
        }

    }
}
