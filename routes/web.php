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

// 成功页面
//Route::get('/admin/success', function(){
//    return view('admin.success')->with([
//        'message'=>'你已经提交申请，请您耐心等待！',
//        'url' =>'/index',
//        'jumpTime'=>30,
//    ]);
//});

// admin登陆页面
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
    
    // admin登陆页面
    Route::get('login', 'LoginController@login');

    // 验证码
    Route::get('captcha', 'LoginController@yzm');
    
    // 验证
    Route::post('login/check', 'LoginController@check');

    // 退出
    Route::get('logout', 'LoginController@logout');
});


// admin
Route::group(['namespace'=>'Admin', 'prefix'=>'admin', 'middleware'=>['AdminLogin']], function(){

	// admin首页
	Route::get('', 'IndexController@index');

	// admin管理员管理---资源路由resource
    Route::resource('admin', 'AdminController');

    // admin状态调整路由
    Route::post('status', 'AdminController@status');

    // 批量删除
    Route::post('dels', 'AdminController@dels');
});

// admin 角色管理
Route::group(['middleware' => 'AdminLogin'], function(){
    Route::resource('/admin/role', 'Admin\RoleController');
});


