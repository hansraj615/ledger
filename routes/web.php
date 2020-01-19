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
Route::group(["prefix" => "admin", "namespace" => "Admin",'middleware' => 'auth'], function () {

    /********* User Management */
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/users/create', 'UserController@create')->name('user.create');
    Route::get('/users/edit/{reference_id}','UserController@edit')->name('user.edit');
    Route::post('/users/destroy/{reference_id}','UserController@destroy')->name('user.destroy');
    Route::post('/users/store', 'UserController@store')->name('user.store');
    Route::POST('/users/update/{reference_id}', 'UserController@update')->name('user.update');
     /********* Company Master */
    Route::get('/company','CompnayController@index')->name('company.index');
    Route::get('/company/edit/{reference_id}','CompnayController@edit')->name('company.edit');
    Route::post('/company/destroy/{reference_id}','CompnayController@destroy')->name('company.destroy');
    Route::get('/search-country/{keyword?}', 'CompnayController@searchCountry')->name('admin.search-country');
    Route::get('/search-state/{keyword?}', 'CompnayController@searchState')->name('admin.search-state');
    Route::get('/search-city/{keyword?}', 'CompnayController@searchCity')->name('admin.search-city');
    Route::get('/search-subcompany/{keyword?}', 'CompnayController@searchSubCompany')->name('admin.search-subcompany');
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

    /***********************CLient Mapping */
    Route::get('/clientmapping', 'ClientMappingController@index')->name('admin.clientmapping.index');
    Route::get('/clientmapping/create', 'ClientMappingController@create')->name('admin.clientmapping.create');
    Route::POST('/clientmapping/store', 'ClientMappingController@store')->name('admin.clientmapping.store');
    Route::get('/clientmapping/edit/{reference_id}','ClientMappingController@edit')->name('clientmapping.edit');
    Route::post('/clientmapping/destroy/{reference_id}','ClientMappingController@destroy')->name('clientmapping.destroy');

    /*********role and permission */
    Route::resource('/roles', 'RoleController');
    Route::post('/roles/destroy/{reference_id}','RoleController@destroy')->name('roles.destroy');
    Route::post('/company/destroy/{reference_id}','CompnayController@destroy')->name('company.destroy');
    Route::resource('/permissions', 'PermissionController');
    Route::post('/permissions/destroy/{reference_id}','PermissionController@destroy')->name('permissions.destroy');
    Route::resource('/pod-users', 'PodUsersController');

    /*******************user profile */
    Route::resource('/user-profile','UserProfileController');
    Route::post('/user-profile-password-update','UserProfileController@updatepassword')->name('password.update');

    /*******************Product master */
    Route::resource('/products','ProductController');
    Route::get('/search-product/{keyword?}', 'ProductController@searchProduct')->name('search-product');
    Route::post('/products/destroy/{reference_id}','ProductController@destroy')->name('product.destroy');




});

