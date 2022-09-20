<?php

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
Route::apiResource('/category', 'Category\CategoryController')->except(['store','update','destroy']);


Route::group(['namespace' => 'Provider\GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
    Route::get('government_area/{id}', 'AreaController@getAllGovernmentAreas');
});


Route::group(['prefix' => 'user/message', 'namespace' => 'Message', 'middleware' => 'auth:user'], function () {

    Route::post('/', 'MessageController@sendMessage');
});

Route::group(['prefix' => 'provider/message', 'namespace' => 'Message','middleware' => 'auth:provider'], function () {

    Route::get('/', 'MessageController@ProviderRetrieveMessages');
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
Route::group([ 'namespace' => 'Provider'], function () {
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

    Route::get('send-mail', function () {

        $details = [
            'title' => 'Tekya.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        Mail::to('anwarsaeed1@yahoo.com')->send(new MyTestMail($details));
       
        dd("Email is Sent.");
    });

    /**
     * login & Reigster
     */
    Route::post('authentication', 'AuthController@authentication');

    
    /**
     * Category Apis
     */

    Route::get('main_categories', 'CategoryController@getCategories');
    Route::get('sub_categories', 'CategoryController@getSubCategories');
    Route::get('category_shops', 'CategoryController@categoryShops');
    Route::get('category_products', 'CategoryController@categoryProducts');

    /**
     * Shops Apis
     */

    Route::get('nearest_shops', 'ShopController@nearestShops');
    Route::get('new_shops', 'ShopController@newShops');
    Route::get('shops_products', 'ShopController@shopsProducts');
    Route::get('shop/products', 'ShopController@getProductsShop');
    Route::get('shop', 'ShopController@getShopDetails');
    Route::get('shop/branches', 'ShopController@getShopBranches');


    /**
     * Prdocuts Modules
     */
    Route::get('products_for_you','ProductController@productsForYou');
    Route::get('most_popular_products','ProductController@mostPopularProduct');
    Route::get('related_products','ProductController@relatedProducts');
    Route::get('similar_products','ProductController@similarProducts');



    /**
     * SearchKeyWords
     */
    Route::get('search','SearchController@search');


});




Route::get('category/{id}/shops', 'Provider\ShopController@getShopByCategoryId');
