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

});

