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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('logout', 'Auth\LogOutController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('preResetPassword', 'Auth\ResetPassController@preResetPassword');
    Route::post('confirmPIN', 'Auth\ResetPassController@confirmPIN');
    Route::post('resetPassword', 'Auth\ResetPassController@resetPassword');

});

/**
 * Nav
 */

//search 

/************************************************/

 Route::group([

    'middleware' => [
        'api',
        'auth:api',
    ],

], function ($router) {

    /**
     * Product APIs //For admin only Except index, show, productImages, reviews //
     */

    //Product CRUD

    Route::apiResource('products', 'Api\ProductController');

    //Product's Images

    Route::get('product/{product}/productImages', 'Api\ProductController@productImages');

    //Product's Reviews

    Route::get('product/{product}/reviews', 'Api\ProductController@reviews');

    /**
     * Product Images APIs //For admin only Except index, show //
     */

    //Product Images CRUD

    Route::apiResource('productImages', 'Api\ProductImageController');

    /**
     * Product Colors APIs //For admin only Except index, show //
     */

    //Product Colors CRUD

    Route::apiResource('productColors', 'Api\ProductColorController');

    /**
     * Product Sizes APIs //For admin only Except index, show //
     */

    //Product Sizes CRUD

    Route::apiResource('productSizes', 'Api\ProductSizeController');

    /**
     * Offer APIs //For admin only Except index, show //
     */

    //Offer CRUD

    Route::apiResource('offers', 'Api\OfferController');

    /**
     * Reviews APIs //For admin only Except index, show //
     */

    //Reviews CRUD

    Route::apiResource('reviews', 'Api\ReviewController');

    /**
     * Cart APIs //For Spacific User // Secured
     * 
     */

    //Cart CRUD

    Route::apiResource('carts', 'Api\CartController');

    /**
     * User APIs //For admin only Except cart, Update, Destroy, changePassword // Secured
     */

    //User CRUD

    Route::apiResource('users', 'Api\UserController');

    //User Cart

    Route::get('user/{user}/cart', 'Api\UserController@cart');
    
    //Change Pasword

    Route::put('user/{user}/changePassword', 'Api\UserController@changePassword');
    
});

//For admin only
Route::group([

    'middleware' => [
        'api',
        'auth:api',
        'admin',
    ],

], function () {

    /**
     * Category APIs 
     * 
     * Model, Factory, Controller, Route, Postman
     * 
     */

    //Category CRUD

    Route::apiResource('categories', 'Api\CategoryController');

    /**
     * Color APIs 
     */

    //Color CRUD

    Route::apiResource('colors', 'Api\ColorController');

    /**
     * Size APIs 
     */

    //Size CRUD

    Route::apiResource('sizes', 'Api\SizeController');
    
});

// Address Module
// Order Module
// Orderproducts Module
// Favorite Module

// return to Handling Middlewares, Securty