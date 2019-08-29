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
