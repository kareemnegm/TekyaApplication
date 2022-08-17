<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('signup', 'User\AuthController@signUp');
Route::post('login', 'User\AuthController@login');
Route::put('changePassword', 'User\AuthController@ChangePassword')->middleware('auth:sanctum');

Route::group(['prefix' => 'government'], function () {
    Route::post('/', 'GovernmentArea\GovernmentController@store');
    Route::put('/{id}', 'GovernmentArea\GovernmentController@update');
    Route::get('/', 'GovernmentArea\GovernmentController@getAllGovernments');
    Route::get('/{id}', 'GovernmentArea\GovernmentController@getGovernment');
    Route::delete('/{id}', 'GovernmentArea\GovernmentController@getGovernment');
});

Route::group(['prefix' => 'area'], function () {
    Route::post('/', 'GovernmentArea\AreaController@store');
    Route::put('/{id}', 'GovernmentArea\AreaController@update');
    Route::get('/government/{id}', 'GovernmentArea\AreaController@getAllGovernmentAreas');
    Route::get('/{id}', 'GovernmentArea\AreaController@getArea');
    Route::delete('/{id}', 'GovernmentArea\AreaController@destroy');
});


Route::group(['prefix' => 'provider'], function () {
    Route::post('/signup', 'User\ProviderController@signUp');
    Route::post('/login', 'User\ProviderController@login');
    Route::post('/shopDetails', 'User\ProviderController@createShopDetails')->middleware(['auth:sanctum']);
    Route::post('/shop/branch', 'User\ProviderController@createBranch')->middleware(['auth:sanctum']);

});



