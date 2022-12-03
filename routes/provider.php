<?php

use Illuminate\Support\Facades\Route;


Route::get('shop/categories', 'CategoryController@shopProductsCategories');

Route::post('logout', 'AuthController@logout');

Route::delete('delete_provider', 'ProviderController@deleteProviderAccount');




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
Route::apiResource('/delivery_coverage', 'DeliveryCoverage');
// Route::put('/deliveryCoverage', 'DeliveryCoverage@update');

/**end of delivery coverage */

/**
 * shopDetails
 */

Route::put('/shopDetails', 'ShopController@updateShopDetails');
Route::get('/shopDetails', 'ShopController@getShopDetails');
Route::get('/shopOpeningTime', 'ShopController@openingTime');
/**
 * /shop/branch
 */
Route::post('/shop/branch', 'BranchController@createBranch');
Route::post('/shop_working_hours', 'ShopController@addWorkingHoursToShop');
Route::get('/shop/branches', 'BranchController@getBranches');
Route::get('/shop/stock_branches', 'BranchController@getBranchesForStocks');
Route::get('/shop/branch', 'BranchController@getBranch');
Route::put('/shop/branch/status', 'BranchController@branchActive');
Route::put('/shop/branch/{id}', 'BranchController@updateBranch');
Route::put('/shop/toggle_delivery_pickup', 'BranchController@branchDeliveryPickUpToggle');
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
Route::get('all_products', 'ProductController@getAllShopProduct');
Route::put('order_product', 'ProductController@orderProduct');
Route::get('products_search', 'ProductController@productsSearch');
Route::get('collections_search', 'ProductController@collectionSearch');
Route::get('products_not_in_collection', 'ProductController@productNotInCollectionSearch');


/**
 * product variants
 */

Route::post('/product_variant', 'ProductController@createProductVariant');
Route::get('/variant_values', 'ProductController@getVariantsValues');
Route::delete('/product_variant/{id}', 'ProductController@DeleteVariant');
Route::delete('/variant_value/{id}', 'ProductController@deleteVariantValue');
Route::get('product/{productId}/variants', 'ProductController@getProductVariants');
Route::get('product/{productId}/branches', 'ProductController@getProductStockBranches');




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
Route::get('/order/{id}', 'OrderController@orderDetails');
Route::put('/order', 'OrderController@updateOrderStatus');
Route::get('/order_search', 'OrderController@OrderSearch');
Route::get('shop_statistics', 'OrderController@shopStatistics');

Route::get('finance_orders', 'OrderController@financeOrders');
Route::get('finance_statistics', 'OrderController@financeStatistics');


Route::get('finance_statistics', 'OrderController@financeStatistics');
Route::get('finance_statistics', 'OrderController@financeStatistics');


/**
 * Customer  Orders
 */
Route::get('customers_orders', 'CustomerController@customersList');
Route::get('customer_order_details', 'CustomerController@customerOrder');

