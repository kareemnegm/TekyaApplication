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




Route::get('government_area/{id}', 'AreaController@getAllGovernmentAreas');
Route::get('/payment', 'Provider\PaymentController@index');
Route::apiResource('/category', 'Category\CategoryController');






Route::group(['prefix' => 'provider', 'namespace' => 'Provider'], function () {
    /**
     * signup
     */
    Route::post('/signup', 'AuthController@signUp');
    /**
     * login
     */
    Route::post('/login', 'AuthController@login');
});


Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    /**
     * signup
     */
    Route::post('signup', 'AuthController@signUp');
    /**
     * login
     */
    Route::post('login', 'AuthController@login');


    Route::get('categories', 'CategoryController@index');
});



Route::get('category/{id}/shops', 'Provider\ShopController@getShopByCategoryId');
