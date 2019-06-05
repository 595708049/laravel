<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    //
    public function index()
    {
        return view('admin.category.list');
    }

    public function add(Request $request)
    {
        if($request->isMethod('get')){
            return view('admin.category.add');
        }elseif($request->isMethod('post')){
            
        }

    }
}
