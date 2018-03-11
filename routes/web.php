<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

	$tasks = DB::table('AUTHORS')->get();

	return $tasks;
   // return view('welcome');
});


Route::post('main','BookController@searchValidate');
Route::get('main','BookController@index');

Route::post('check_out','BookController@checkOutComplete');
Route::get('check_out','BookController@checkOut');

Route::get('check_in','BookController@checkInIndex');
Route::post('check_in','BookController@checkInComplete');
Route::post('check_in_search','BookController@checkInSearchValidate');

Route::get('create_borrower','BorrowerController@index');
Route::post('create_borrower','BorrowerController@create');

Route::get('fine','FineController@displayFines');
Route::post('fine','FineController@updateFines');


Route::post('fine_pay','FineController@payment');
