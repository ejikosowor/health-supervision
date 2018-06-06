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

//Api authentication route
Route::group(['namespace' => 'Api'], function() {

    Route::prefix('auth')->group(function () {
        Route::post('login', 'LoginController@login');
        Route::post('refresh', 'LoginController@tokenRefresh');
        Route::post('password-change', 'LoginController@savePassword')->middleware('jwt.auth');
    });

    Route::group(['middleware' => ['jwt.auth']], function () {
        
        //Get General Data
        Route::get('genericdata', 'GeneralController@index');         

        //Post Supervision data
        Route::post('supervision', 'SupervisionController@store');
    });
}); 