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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register','FrontendController@api_register_submit')->name('register_submit');
Route::post('login','FrontendController@api_login_submit')->name('login_submit');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('update-profile','FrontendController@api_update_profile')->name('update_profile');
    Route::post('logout','FrontendController@api_logout')->name('logout');
    Route::post('get-profile','FrontendController@api_profile')->name('get-profile');
    Route::post('place-order','FrontendController@api_order')->name('place-order');
});

Route::get('get-products','FrontendController@api_get_products');
Route::get('get-product-price/{id}','FrontendController@api_get_product_price');
Route::get('get-category/{id}','FrontendController@api_get_category');
Route::get('get-categorylist','FrontendController@api_get_categorylist');
Route::get('get-bannerlist','FrontendController@api_get_bannerlist');

Route::post('add-password','FrontendController@add_password')->name('add_password');
