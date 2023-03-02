<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\PegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichhp 
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'loans', 'namespace' => 'Loans'], function(){

    route::get('/', 'LoanController@index')->name('loans');
    route::get('create/{type}',  'LoanController@create')->name('loans.create');
    route::post('kalkulasi/{type}','LoanController@kalkulasi')->name('loans.kalkulasi');
    route::post('store/{type}','LoanController@store')->name('loans.store');
    route::post('{loan}','LoanController@destroy')->name('loans.destroy');
    route::get('submissions', 'SubmissionController@index')->name('submissions');
    route::post('submissions/{loan}','SubmissionController@store')->name('submissions.store');

});

route::group(['namespace'], function(){
    route::resource('types', 'TypeController');
});

Route::group(['prefix' =>'savings'],  function(){
    route::get('/anggota', 'Savings\SavingController@index')->name('savings.anggota');
    route::get('create', 'Savings\SavingController@create')->name('savings.create');
    route::post('store', 'Savings\SavingController@store')->name('savings.store');
    route::get('edit/{saving}', 'Savings\SavingController@edit')->name('savings.edit');
    route::patch('update/{saving}', 'Savings\SavingController@update')->name('savings.update');
});

Route::group(['prefix' => 'transaksi'], function(){
    route::get('', 'TransaksiController@index')->name('transaksi');
    route::get('edit/{saving}', 'TransaksiController@edit')->name('transaksi.edit');
    route::patch('store/{saving}', 'TransaksiController@store')->name('transaksi.store');
    route::get('cetak-butki/{withdrawal}','KwitansiController@show')->name('transaksi.cetak-bukti');
});

Route::group(['prefix'=> 'installments', 'namespace'=>'Installments'], function(){
    route::get('/', 'InstallmentController@index')->name('installments.index');
    route::get('/{loan}','InstallmentController@show')->name('installments.show');
    route::get('/{loan}/create', 'InstallmentController@create')->name('installments.create');
    Route::post('{loan}/store', 'InstallmentController@store')->name('installments.store');
});



Route::group(['prefix' => 'users', 'namespace' => 'Users'], function(){
    Route::get('pegawai','PegawaiController@index')->name('pegawai.index');
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('create', 'UserController@create')->name('users.create');   
    Route::get('{user}/edit', 'UserController@edit')->name('users.edit');           
    Route::patch('{user}/update', 'UserController@update')->name('users.update');           
    Route::get('anggota','AnggotaController@index')->name('anggota.index');
   
});

Route::group(['prefix' =>'reports'], function(){
    Route::get('reports/anggota', 'Report\AnggotaController@moon')->name('reports.anggota');
    Route::get('reports/all/anggota', 'Report\AnggotaController@all')->name('reports.all.anggota');
    Route::get('reports/loans', 'Report\LoanController@moon')->name('reports.loans');
    Route::get('reports/all/loans', 'Report\LoanController@all')->name('reports.all.loans');
    Route::get('reports/installments', 'Report\InstallmentController@moon')->name('reports.installments');
    Route::get('reports/all/installments', 'Report\InstallmentController@all')->name('reports.all.installments');
    Route::get('reports/all/savings', 'Report\SavingController@all')->name('reports.all.savings');
});


