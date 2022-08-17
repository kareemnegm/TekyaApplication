<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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





Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
    Route::get('government_area/{id}', 'AreaController@getAllGovernmentAreas');

    
});





Route::group(['prefix' => 'provider' , 'namespace' => 'Provider'], function () {
        /**
         * signup
         */
        Route::post('/signup', 'AuthController@signUp');
        /**
         * login
         */
        Route::post('/login', 'AuthController@login');
  
});


Route::group(['prefix' => 'user' , 'namespace' => 'User'], function () {
    /**
     * signup
     */
    Route::post('signup','AuthController@signUp');
    /**
     * login
     */
    Route::post('login','AuthController@login');
});


