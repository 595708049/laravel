<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class IndexController extends BaseController
{
    //  后台首页
    public function index()
    {
        return view('Admin/Index/index');
    }
}
