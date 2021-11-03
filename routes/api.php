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
Route::group(['middleware' => ['basic-authenticate'],'namespace'=>'Api','prefix'=>'dc'], function() {
    Route::get('/valid/{address}', 'ApiController@isValid');
    Route::post('/send', 'ApiController@send');
});
