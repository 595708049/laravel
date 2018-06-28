<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * 列表显示页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('admin')->get();
//        dd($data);
        return view("admin.admin.list", ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 添加页面
     */
    public function create()
    {
        return view('admin.admin.add');
        //
    }

    /**
     * Store a newly created resource in storage.
     * 数据添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*数据验证
        $data = $request->all();
        $rule = [
            'adminName' => 'required|unique:admin',
            'password' => 'required|same:password2',
        ];
        $message = [
            'adminName.required' => '请输入用户名',
            'adminName.unique'   => '用户名已经存在',
            'password.same'      => '两次密码不一样',
            'password.required'  => '请输入密码',
        ];
        $validator = \Validator::make($data, $rule, $message);
//        dd($validator);
        */
        //
//        if($validator->passes()){
            $adminName = $request->input('adminName');
            $password = $request->input('password');
//        $password2 = $request->input('password2');
            $sex = $request->input('sex');
//        $phone = $request->input('phone');
            $adminRole = $request->input('adminRole');
            $status = $request->input("status");
            $arr = [
                'name'     => $adminName,
                'password' => md5($password),
                'sex'      => $sex,
                'role'     => $adminRole,
                'addtime'  => time(),
                'status'   => $status,
            ];
            // 判断用户名是否存在
            $name = \DB::table('admin')->where(['name'=>$adminName])->count();
            if($name > 0){
                return view('admin.success')->with([
                    'message'=>'用户名已经存在！',
                    'url' => url('admin/admin/create'),
                    'jumpTime'=>3,
                ]);
            }
            $res = \DB::table('admin')->insert($arr);
//        dd($res);
            if($res){
                return view('admin.success')->with([
                    'message'=>'添加成功！',
                    'url' => url('admin/admin/create'),
                    'jumpTime'=>3,
                ]);
            }else{
                return view('admin.success')->with([
                    'message'=>'添加失败！',
                    'url' => url('admin/admin/create'),
                    'jumpTime'=>3,
                ]);
            }
//        }else{
////            dd($validator->getMessageBag()->getMessages());
//             return $validator->getMessageBag()->getMessages();
//        }

    }


    /**
     * Display the specified resource.
     * 显示资源详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = \DB::table('admin')->where(['id'=>$id])->first();
//        dd($data);
        return view("admin.admin.edit", ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     * 更新操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        dd($_POST);
    }

    /**
     * Remove the specified resource from storage.
     * 删除    
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * admin状态修改 1、启用 0、禁用
     */
    public function status(Request $request)
    {
//        return dd($request->all());
        $arr = $request->except('_token');   // 剔除_token
//        return dd($arr);

        $res = \DB::table("admin")->where(['id'=>$arr['id']])->update(['status'=>$arr['status']]);
        if($res == 1){
            return 1;
        }else{
            return 0;
        }
//        return dd($res);
    }
}
