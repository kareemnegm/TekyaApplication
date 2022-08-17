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