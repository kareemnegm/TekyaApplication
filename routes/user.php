<?php
use Illuminate\Support\Facades\Route;


/**
 *
 * change password
 */

Route::put('changePassword', 'AuthController@ChangePassword');

Route::group(['prefix' => 'cart'], function () {
    Route::post('/product', 'CartController@addProductsToCart');
    Route::put('/product/quantity', 'CartController@IncreaseOrDecreaseProductQuantity');
});
