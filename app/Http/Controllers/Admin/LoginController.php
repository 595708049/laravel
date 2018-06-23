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
}
