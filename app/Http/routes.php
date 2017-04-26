<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/test{id}','PaymentController@test');

Route::group(['middleware'=> 'auth'], function (){ 
Route::get('/tienda','PaymentController@index');


Route::get('/comprar/{id}','PaymentController@comprar');

Route::post('tarjeta','PaymentController@pago');

Route::post('regpago','PaymentController@regpago');


Route::get('/', 'HomeController@index');
});
Route::auth();

//Route::get('/home', 'HomeController@index');
