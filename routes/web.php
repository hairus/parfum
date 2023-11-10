<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('cs', 'ClientController@index');
    Route::get('sc', 'ClientController@sc')->middleware('auth');
    Route::get('getData', 'ClientController@getData');
    Route::get('edit/{id}', 'ClientController@edit');
    Route::post('update', 'ClientController@update');
    Route::delete('destroy/{id}', 'ClientController@destroy');

    // transaksi
    Route::get("show/{id}", 'TransaksiController@show');
    Route::post("simpanTrx", 'TransaksiController@simpanTrx');
    Route::get("claim/{id}", 'TransaksiController@claim');
    Route::get("hapusStempel/{id}", 'TransaksiController@hapusStempel');
    Route::post("hapusStempel", 'TransaksiController@hapusStempel1');
});

