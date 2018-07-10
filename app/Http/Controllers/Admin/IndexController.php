<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    //  后台首页
    public function index()
    {
        return view('admin/index/index');
    }
}
