<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //登陆页面
    public function login()
    {
    	return view('admin/login/login');
    }

    // 验证码
    public function yzm()
    {
        return captcha();
    }

    // 验证验证码是否正确
    public function check(Request $request)
    {
//        dd($request->all());
        $name = $request->input('name');
        $pwd = $request->input('password');
        $captcha = $request->input('captcha');
        if($captcha == '' || $captcha == '验证码:') {
           return view('admin.success')->with([
               'message'=>'请填写验证码！',
               'url' => url('admin/login'),
               'jumpTime'=>3,
           ]);
        }
//        dd(captcha_check($captcha));
        if(!captcha_check($captcha)){
            return view('admin.success')->with([
                'message'=>'验证码错误！',
                'url' => url('admin/login'),
                'jumpTime'=>3,
            ]);
        }
        $data = \DB::table('admin')->where(['name'=>$name])->first();
//        dd($data);
        if($data){
            $pwd = md5($pwd);
            if($pwd !== $data->password){
                // 密码错误
                return view('admin.success')->with([
                    'message'=>'用户名或密码错误！',
                    'url'=>url('admin/login'),
                    'jumpTime'=>3
                ]);
            }else{
                // 登录成功
                session(['admin'=>$data]);
//                dd(session('admin'));
                return redirect('/admin/admin');
            }

        }else{
            // 用户名错误
            return view('admin.success')->with([
                'message'=>'用户名或密码错误！',
                'url'=>url('admin/login'),
                'jumpTime'=>3
            ]);
        }

    }

    // 退出
    public function logout(Request $request)
    {
//        dd(session('admin'));
        $request->session()->flush();
//        dd(session('admin'));
        return redirect('/admin/login');
    }
}
