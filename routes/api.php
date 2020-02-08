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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'check-json','cors'], function () {
    Route::post('ledger/login', 'Api\HomeController@index');
    Route::group(['middleware' => 'users-api-auth'], function () {
        Route::post('users/change-password', 'Api\HomeController@changePassword');
        Route::get('ledger/company', 'Api\CompanyApiController@getCompanyApi');
        Route::get('ledger/edit-company', 'Api\CompanyApiController@editCompanyApi');
        Route::post('ledger/update-company', 'Api\CompanyApiController@updateCompanyApi');
    });
});
