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

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');     
    Route::get('/change-password', 'HomeController@changePassword')->name('password.new');     
    Route::post('/change-password', 'HomeController@savePassword')->name('password.save');     

    //Survey management routes
    Route::resource('/supervisions', 'Admin\SupervisionController', ['only' => ['index', 'show']]);

    Route::get('/supervisions/{supervision}/download', 'Admin\SupervisionController@download')->name('supervision.download');
    
    Route::group(['middleware' => ['role:1']], function () {   

        Route::group(['namespace' => 'Admin'], function() {
            //User management Routes
            Route::resource('/users', 'UserController', ['except' => ['create', 'show', 'destroy']]);
            
            Route::resource('/counties', 'CountyController', ['only' => ['index', 'show']]);
            Route::get('/counties/{county}/sub-counties/{subcounty}', 'CountyController@showSubCounty')->name('subcounty.show');

            //Facility management routes        
            Route::resource('/facilities', 'FacilityController');            
            Route::get('/facilities/{facility}/analytics', 'FacilityController@showAnalytics')->name('facilities.analytics');            
        });

        Route::group(['namespace' => 'Supervision'], function() {
            //Supervision Categores Routes
            Route::resource('/categories', 'CategoryController', ['only' => ['index', 'show', 'store']]);

            //Supervision Categores Routes
            Route::post('/areas', 'AreaController@store')->name('areas.store');

            //Supervision Categories Questions Routes
            Route::resource('/categories/{category}/questions', 'QuestionController', ['only' => ['store', 'update', 'edit']]);
            Route::post('/categories/{category}/sub-questions', 'QuestionController@subQuestion')->name('sub-question.store');
        });
    });

    Route::group(['middleware' => ['role:4'], 'namespace' => 'Supervision'], function () {
        
        //Online Supervision routes for health representative
        Route::get('/online-supervisions', 'SupervisionController@index')->name('online-supervisions.index');        
        Route::get('/online-supervisions/{category}/create', 'SupervisionController@create')->name('online-supervisions.create');        
        Route::post('/online-supervisions/{category}/store', 'SupervisionController@store')->name('online-supervisions.store');
        Route::get('/online-supervisions/{category}/show', 'SupervisionController@show')->name('online-supervisions.show');                
    });  

});

//Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');