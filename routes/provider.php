<?php
use Illuminate\Support\Facades\Route;


/**
 * shopDetails
 */
Route::post('/shopDetails', 'ShopController@createShopDetails');
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


/**
 * Bundel
 */
Route::apiResource('/bundel', 'BundelController');


/**
 * government and area
 */

Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
});
