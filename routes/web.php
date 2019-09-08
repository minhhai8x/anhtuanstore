<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/product', function () {
        return view('layouts.product');
    });

    Route::get('/news', function () {
        return view('layouts.news');
    });

    Route::get('/contact', function () {
        return view('layouts.contact');
    });

    Route::get('/cart', ['as' => 'getCart', 'uses' => 'CartController@cart']);
    Route::post('/cart', ['as' => 'postCart', 'uses' => 'CartController@cart']);

    Route::get('/cart/up-qty', ['as' => 'getCartIncreaseQty', 'uses' => 'CartController@increaseQuantity']);
    Route::get('/cart/down-qty', ['as' => 'getCartDecreaseQty', 'uses' => 'CartController@decreaseQuantity']);
    Route::get('/cart/remove-item', ['as' => 'getCartRemoveItem', 'uses' => 'CartController@removeItem']);

    Route::get('/checkout', ['as' => 'getCheckOut', 'uses' => 'CartController@getCheckOut']);
    Route::post('/checkout', ['as' => 'postCheckOut', 'uses' => 'CartController@postCheckOut']);
    Route::get('/checkout-success', ['as' => 'getCheckOutSuccess', 'uses' => 'CartController@getCheckOutSuccess']);
});

Route::get('admincp/login', ['as' => 'getLogin', 'uses' => 'Admin\AdminLoginController@getLogin']);
Route::post('admincp/login', ['as' => 'postLogin', 'uses' => 'Admin\AdminLoginController@postLogin']);
Route::get('admincp/logout', ['as' => 'getLogout', 'uses' => 'Admin\AdminLoginController@getLogout']);
Route::group(['middleware' => 'CheckAdminLogin', 'prefix' => 'admincp', 'namespace' => 'Admin'], function() {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'AdminHomeController@index']);
    Route::resource('category', 'AdminCategoryController');
    Route::resource('product', 'AdminProductController');
    Route::get('/orders', ['as' => 'orders', 'uses' => 'AdminOrderController@index']);
});

Route::get('login', ['as' => 'getUserLogin', 'uses' => 'UserLoginController@getUserLogin']);
Route::post('login', ['as' => 'postUserLogin', 'uses' => 'UserLoginController@postUserLogin']);
Route::get('logout', ['as' => 'getUserLogout', 'uses' => 'UserLoginController@getUserLogout']);
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['CheckUserLogin', 'setlocale']], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});
