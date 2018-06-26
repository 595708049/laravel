<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class LoginController extends BaseController
{
    //登陆页面
    public function login()
    {
    	return view('Admin/Login/login');
    }

    // 验证码
    public function yzm()
    {
        return captcha();
    }

    // 验证验证码是否正确
    public function check(Request $request)
    {
//        dd($_POST);
//        $name = $request->input('name');
//        $pwd = $request->input('password');
        $captcha = $request->input('captcha');
//        if($captcha == '' || $captcha == '验证码:') {
//
//        }
        dd(captcha_check($captcha));
    }
}
