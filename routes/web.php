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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/product', function () {
    return view('layouts.product');
});

Route::get('/news', function () {
    return view('layouts.news');
});

Route::get('/contact', function () {
    return view('layouts.contact');
});

Route::get('admincp/login', ['as' => 'getLogin', 'uses' => 'Admin\AdminLoginController@getLogin']);
Route::post('admincp/login', ['as' => 'postLogin', 'uses' => 'Admin\AdminLoginController@postLogin']);
Route::get('admincp/logout', ['as' => 'getLogout', 'uses' => 'Admin\AdminLoginController@getLogout']);
Route::group(['middleware' => 'CheckAdminLogin', 'prefix' => 'admincp', 'namespace' => 'Admin'], function() {
    Route::get('/', function() {
        return view('admin.home');
    });
});

Route::get('login', ['as' => 'getUserLogin', 'uses' => 'UserLoginController@getUserLogin']);
Route::post('login', ['as' => 'postUserLogin', 'uses' => 'UserLoginController@postUserLogin']);
Route::get('logout', ['as' => 'getUserLogout', 'uses' => 'UserLoginController@getUserLogout']);
Route::group(['middleware' => 'CheckUserLogin'], function() {
    Route::get('/', function() {
        return view('layouts.home');
    });
});
