<?php

use Illuminate\Support\Facades\Route;


Route::get('shop/categories', 'CategoryController@shopProductsCategories');

Route::post('logout', 'AuthController@logout');


/**
 *
 * ! sale
 */

Route::apiResource('sale', 'SaleController')->except(['update', 'show']);
Route::put('sale', 'SaleController@update');
Route::get('show_sale', 'SaleController@show');

/**
 *
 * !end of sale
 */

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



/**delivery coverage */

Route::apiResource('/deliveryCoverage', 'DeliveryCoverage')->except(['update']);
Route::put('/deliveryCoverage', 'DeliveryCoverage@update');

/**end of delivery coverage */

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
Route::get('/shop/branch', 'BranchController@getBranch');
Route::put('/shop/branch/{id}', 'BranchController@updateBranch');
Route::put('/branch/{id}/remove_payment_option', 'BranchController@removePaymentOptionFromBranch');
Route::delete('/shop/branch/{id}', 'BranchController@deleteBranch');


/**
 * collections
 */
Route::apiResource('/collection', 'CollectionController');
Route::put('collection_rename', 'CollectionController@rename');
Route::put('collection_published', 'CollectionController@publish_unPublish');

/**
 * Prodcut
 */
Route::apiResource('/product', 'ProductController')->except(['index', 'destroy']);
Route::delete('/product', 'ProductController@destroy');
Route::put('/product_publish', 'ProductController@publishOrUnPublishProduct');
Route::put('/product_remove_collection', 'ProductController@remove_product_from_collection');
Route::put('/move_product_collection', 'ProductController@move_product_from_collection');
Route::get('collection/{id}/products', 'ProductController@index');
Route::put('order_product', 'ProductController@orderProduct');
/**
 * product variants
 */

Route::post('/product_variant', 'ProductController@createProductVariant');
Route::get('/variant_values', 'ProductController@getVariantsValues');
Route::delete('/product_variant/{id}', 'ProductController@DeleteVariant');
Route::delete('/variant_value/{id}', 'ProductController@deleteVariantValue');

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


/**shop orders  */

Route::get('/orders', 'OrderController@shopOrders');
Route::put('/order', 'OrderController@updateOrderStatus');
