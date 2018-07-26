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
	return view('welcome');
});

Route::resource('ongkir', 'OngkirCtrl');
Route::get('get_kota', 'OngkirCtrl@getKota')->name('getKota');
Route::get('get_tarif', 'OngkirCtrl@getTarif')->name('getTarif');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
