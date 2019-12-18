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

use App\Http\Controllers\Admin\CompnayController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(["prefix" => "admin", "namespace" => "Admin"], function () {

    Route::get('/company','CompnayController@index')->name('company.index');
    Route::get('/company/edit/{reference_id}','CompnayController@edit')->name('company.edit');
    Route::post('/company/destroy/{reference_id}','CompnayController@destroy')->name('company.destroy');
    Route::get('/search-country/{keyword?}', 'CompnayController@searchCountry')->name('admin.search-country');
    Route::get('/search-state/{keyword?}', 'CompnayController@searchState')->name('admin.search-state');
    Route::get('/search-city/{keyword?}', 'CompnayController@searchCity')->name('admin.search-city');
    Route::POST('/company/store', 'CompnayController@store')->name('admin.company.store');
    Route::get('/company/create', 'CompnayController@create')->name('admin.company.create');
    Route::POST('/company/update/{reference_id}', 'CompnayController@update')->name('admin.company.update');

    /***********************Sub Company */
    Route::get('/subcompany','SubCompnayController@index')->name('subcompany.index');
    Route::get('/subcompany/edit/{reference_id}','SubCompnayController@edit')->name('subcompany.edit');
    Route::POST('/subcompany/store', 'SubCompnayController@store')->name('admin.subcompany.store');
   
    Route::post('/subcompany/destroy/{reference_id}','SubCompnayController@destroy')->name('subcompany.destroy');
    Route::get('/subcompany/create', 'SubCompnayController@create')->name('admin.subcompany.create');

    /***********************Sub Company opening balance */
    Route::get('/subcompanystock','CompanyStockController@index')->name('subcompanystock.index');
     Route::get('/subcompanystock/edit/{reference_id}','CompanyStockController@edit')->name('subcompanystock.edit');
     Route::POST('/subcompanystock/store', 'CompanyStockController@store')->name('admin.subcompanystock.store');
     Route::post('/subcompanystock/destroy/{reference_id}','CompanyStockController@destroy')->name('subcompanystock.destroy');
     Route::get('/subcompanystock/create', 'CompanyStockController@create')->name('admin.subcompanystock.create');

     /***********************Client */  
    Route::get('/client','ClientController@index')->name('client.index');
    Route::get('/client/edit/{reference_id}','ClientController@edit')->name('client.edit');
    Route::POST('/client/store', 'ClientController@store')->name('admin.client.store');
    Route::post('/client/destroy/{reference_id}','ClientController@destroy')->name('client.destroy');
    Route::get('/client/create', 'ClientController@create')->name('admin.client.create');

    /***********************LedgerEntry */  
    Route::get('/ledger','LedgerEntryController@index')->name('ledger.index');
    Route::get('/ledger/edit/{reference_id}','LedgerEntryController@edit')->name('ledger.edit');
    Route::POST('/ledger/store', 'LedgerEntryController@store')->name('admin.ledger.store');
    Route::post('/ledger/destroy/{reference_id}','LedgerEntryController@destroy')->name('ledger.destroy');
    Route::get('/ledger/create', 'LedgerEntryController@create')->name('admin.ledger.create');
    Route::get('/search-client/{keyword?}', 'LedgerEntryController@SearchClient')->name('ledger.search-client');

    /***********************LedgerEntry */ 
    Route::get('/clientmapping', 'ClientMappingController@index')->name('admin.clientmapping.index'); 
    Route::get('/clientmapping/create', 'ClientMappingController@create')->name('admin.clientmapping.create');
    Route::POST('/clientmapping/store', 'ClientMappingController@store')->name('admin.clientmapping.store');


});

