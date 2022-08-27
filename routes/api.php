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

Route::get('/payment', 'Provider\PaymentController@index');
Route::apiResource('/category', 'Category\CategoryController');


Route::group(['namespace' => 'Provider\GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
    Route::get('government_area/{id}', 'AreaController@getAllGovernmentAreas');
});


Route::group(['prefix' => 'user/message', 'namespace' => 'Message', 'middleware' => 'auth:user'], function () {

    Route::post('/', 'MessageController@sendMessage');
});
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

    Route::get('main_categories', 'CategoryController@getCategories');
    Route::get('sub_categories/{categoryID}', 'CategoryController@getSubCategories');
    Route::get('category_shops/{categoryID}', 'CategoryController@categoryShops');
    Route::get('category_products/{categoryID}', 'CategoryController@categoryProducts');

    /**
     * Shops Apis
     */

    Route::get('nearest_shops', 'ShopController@nearestShops');
    Route::get('new_shops', 'ShopController@newShops');
    Route::get('shops_products', 'ShopController@shopsProducts');


});




Route::get('category/{id}/shops', 'Provider\ShopController@getShopByCategoryId');
