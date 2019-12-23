<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// cart routes starts
Route::group(['prefix'=>'carts'],function(){
	// show cart page
	Route::get('/','API\CartsController@index')->name('carts');
	// carts data store into db
	Route::post('/store','API\CartsController@store')->name('carts.store');
	// carts update data store into db
	Route::post('/update/{id}','API\CartsController@update')->name('carts.update');
	// carts data delete
	Route::post('/delete/{id}','API\CartsController@destroy')->name('carts.destroy');

	});
