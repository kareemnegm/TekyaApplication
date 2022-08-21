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
 * government and area
 */

Route::group(['namespace' => 'GovernmentArea'], function () {
    Route::apiResource('government', 'GovernmentController');
    Route::apiResource('area', 'AreaController');
});
