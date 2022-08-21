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


 /**payment option */

 Route::apiResource('/payment', 'PaymentController');

 /**end of payment option  */

/**
 * shopDetails
 */

Route::put('/shopDetails', 'ShopController@updateShopDetails');
Route::get('/shopDetails', 'ShopController@getShopDetails');
/**
 * /shop/branch
 */
Route::post('/shop/branch', 'BranchController@createBranch');
Route::get('/shop/branches', 'BranchController@getBranches');
Route::put('/shop/branch/{id}', 'BranchController@updateBranch');
Route::delete('/shop/branch/{id}', 'BranchController@deleteBranch');


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
Route::apiResource('/bundle', 'BundelController');
Route::put('order_bundle', 'BundelController@orderBundel');



/**
 * government and area
 */

Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
});
