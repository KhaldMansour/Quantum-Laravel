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

Route::group(['namespace' => 'App\Http\Controllers\API'], function ($router) {

    Route::group(['prefix' => 'user'] , function ($router) {
        
        Route::post('login', 'UserController@login');

        Route::post('register', 'UserController@register');
    });

    Route::group(['prefix' => 'categories'] , function ($router) {

        Route::get('', 'CategoryController@index');

        Route::get('{id}', 'CategoryController@show');

        Route::post('', 'CategoryController@store');

        Route::post('{id}/product', 'CategoryController@associateProduct');

    });

    Route::group(['prefix' => 'products'] , function ($router) {

        Route::get('', 'ProductController@index');

        Route::get('{id}', 'ProductController@show');

        Route::get('active-products', 'ProductController@activeProducts');
        
        Route::post('', 'ProductController@store');
    });

    Route::group(['prefix' => 'orders' , 'middleware' => 'is_client'] , function ($router) {

        Route::get('my-orders', 'OrderController@index');

        Route::post('add-order', 'OrderController@addOrder');

        Route::post('place-orders', 'OrderController@placeOrders');
    });
});

