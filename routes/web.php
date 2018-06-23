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
// 首页
Route::get('/', function () {
    return view('welcome');
});
// admin
Route::group(['namespace'=>'Admin', 'prefix'=>'admin', 'middleware'=>'AdminLogin'], function(){

	// admin首页
	Route::get('', 'IndexController@index');

	// admin登陆页面
	Route::get('login', 'LoginController@login');
});


