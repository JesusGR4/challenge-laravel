<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'auth'], function () {

    // AUTH
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'UserController@signup');

    // LOGGED CONTROLLERS
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::post('update', 'UserController@update');
        Route::post('delete', 'UserController@delete');
    });
});
Route::group(['prefix' => 'cart'], function () {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('updateQuantity' , 'CartController@updateQuantity');
        Route::post('deleteProduct' , 'CartController@deleteProduct');
        Route::post('deleteCart', 'CartController@deleteCart');
        Route::get('getSellerAmount','CartController@getSellerAmount');
        Route::get('getAmountCart', 'CartController@getAmountCart');
        Route::get('commitBuy', 'CartController@commitBuy');
    });
});
Route::group(['prefix' => 'order'], function () {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('getOrders' , 'OrderController@getOrders');
        Route::get('getSpentMoney' , 'OrderController@getSpentMoney');
    });
});

Route::group(['prefix' => 'seller'], function(){
    // SELLER
    Route::post('create', 'SellerController@create');
    Route::post('update', 'SellerController@update');
    Route::post('delete', 'SellerController@delete');
});

Route::group(['prefix' => 'product'], function(){
    // SELLER
    Route::post('create', 'ProductController@create');
    Route::post('update', 'ProductController@update');
    Route::post('delete', 'ProductController@delete');
});

Route::group(['prefix' => 'provision'], function(){
    // SELLER
    Route::post('create', 'ProductSellerController@create');
    Route::post('update', 'ProductSellerController@update');
    Route::post('delete', 'ProductSellerController@delete');
});