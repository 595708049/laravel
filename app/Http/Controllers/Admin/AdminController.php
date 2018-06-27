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
        return view("Admin.Admin.list", ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 添加页面
     */
    public function create()
    {
        return view('Admin.Admin.add');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
        if($validator->passes()){
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
            $res = \DB::table('admin')->insert($arr);
//        dd($res);
            if($res){
                return view('Admin.success')->with([
                    'message'=>'添加成功！',
                    'url' => url('admin/admin/create'),
                    'jumpTime'=>3,
                ]);
            }else{
                return view('Admin.success')->with([
                    'message'=>'添加失败！',
                    'url' => url('admin/admin/create'),
                    'jumpTime'=>3,
                ]);
            }
        }else{
            dd($validator->getMessageBag()->getMessages());
             return $validator->getMessageBag()->getMessages();
        }

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
        dd($id);
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
}
