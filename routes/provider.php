<?php
use Illuminate\Support\Facades\Route;


/***
 *
 * !my account
 */
Route::put('/myAccount', 'ProviderController@updateShopAndUserName');
Route::put('changePassword', 'AuthController@ChangePassword');



/**
 * !end of my account
 */



/**
 * shopDetails
 */

Route::post('/shopDetails', 'ShopController@updateShopDetails');
/**
 * /shop/branch
 */
Route::post('/shop/branch', 'BranchController@createBranch');

/**
 * collections
 */
Route::apiResource('/collection', 'CollectionController');

/**
 * Prodcut
 */
Route::apiResource('/product', 'ProductController')->except(['index']);
Route::get('collection/{id}/products', 'ProductController@index');
Route::put('order_product', 'ProductController@orderProduct');



/**
 * Bundel
 */
Route::apiResource('/bundel', 'BundelController');
Route::put('order_bundel', 'BundelController@orderBundel');



/**
 * government and area
 */

Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
});
