<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
//            dd($request->session()->all());
//            dd(session('admin'));
//            dd($request->session()->get('admin'));
//            $request->session()->get('admin');
            return $next($request);
        });
    }
}
