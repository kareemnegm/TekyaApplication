<?php

use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'admin'], function () {
    /**
     * signup
     */
    Route::post('/signup', 'AuthController@signUp')->withoutMiddleware('auth:admin');
    /**
     * login
     */
    Route::post('/login', 'AuthController@login')->withoutMiddleware('auth:admin');

    Route::put('changePassword', 'AuthController@ChangePassword');

});
