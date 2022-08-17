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
 * government and area
 */

Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
});
