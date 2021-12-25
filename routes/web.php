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

Route::get('/cari-huruf-duplikat-pertama', 'HomeController@cari_huruf_duplikat_pertama')->name('cari-huruf-duplikat-pertama');
Route::get('/sebuah-tangga', 'HomeController@sebuah_tangga')->name('sebuah-tangga');

Auth::routes();
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/home', 'RekeningController@index')->name('home');
    Route::view('/form-topup', 'rekening.topup')->name('rekening.form-topup');
    Route::view('/form-withdraw', 'rekening.withdraw')->name('rekening.form-withdraw');
    Route::get('/mutasi', 'RekeningController@mutasi')->name('rekening.mutasi');
    Route::post('/topup', 'RekeningController@topup')->name('rekening.topup');
    Route::post('/withdraw', 'RekeningController@withdraw')->name('rekening.withdraw');
});
