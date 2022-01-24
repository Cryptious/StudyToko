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

Route::get('/', 'Utama@index' );
Route::post('/pushData','Utama@store');
Route::get('/Login','Login@index');
Route::post('/Daftar','Login@Register');
Route::post('/Masuk','Login@Masuk');
Route::get('/Keluar','Login@Keluar');
Route::post('/AddCart','Order@Order');
