<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AdminRole;
use App\Admin;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     * 列表显示页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('admin')->paginate(10);
        $count = \DB::table('admin')->count();
//        dd($data);
        return view("admin.admin.list", ['data'=>$data, 'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 添加页面
     */
    public function create()
    {
        // 角色信息
        $role = \DB::table('role')->get();
//        dd($role );
        return view('admin.admin.add', ['role'=>$role]);
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
      // dd($request->all());
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
            $res = \DB::table('admin')->insertGetId($arr);   // 返回插入的id

            if($res){
                
//                $admin_role = new AdminRole();
//                $admin_role->admin_id = $res;
//                $admin_role->role_id = $adminRole;
//                $admin_role->save();
                $admin = Admin::find($res);
//                dd($admin);
                $admin->role()->attach($adminRole);
                
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
        $data = \DB::table('admin')->select("admin.*", "role.roleName")
            ->leftJoin('role', 'admin.role', '=', 'role.id')
            ->where(['admin.id'=>$id])->first();
//        dd($data);
        $role = \DB::table('role')->get();

        return view("admin.admin.edit", ['data'=>$data, 'role'=>$role]);
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
//        dd($request->all());
          $arr = $request->except(['_method', '_token', 'password2']);  // 剔除
//          dd($arr);
          $name = \DB::table('admin')->where('id', '<>', $id)->pluck('name');
//          dd($name);
          $n = $name->toArray();
//          dd($n);
//        echo $arr['adminName'];exit;
          $a = $arr['adminName'];
          if(in_array($a, $n)){
              return view('admin.success')->with([
                  'message'=>'修改失败！',
                  'url' => url('admin/admin/' . $id . '/edit'),
                  'jumpTime'=>3,
              ]);
          }
          $arr1 = [
              'name'     => $arr['adminName'],
              'password' => md5($arr['password']),
              'sex'      => $arr['sex'],
              'role'     => $arr['adminRole'],
              'status'   => $arr['status']
          ];
//          dd($arr1);
          $res = \DB::table('admin')->where(['id'=>$id])->update($arr1);
//          dd($res);
          if($res){
              $admin = Admin::find($id);
              $admin->role()->attach($arr['adminRole']);
              return view('admin.success')->with([
                  'message'=>'修改成功！',
                  'url' => url('admin/admin/'),
                  'jumpTime'=>3,
              ]);
          }else{
              return view('admin.success')->with([
                  'message'=>'修改失败！',
                  'url' => url('admin/admin/' . $id . '/edit'),
                  'jumpTime'=>3,
              ]);
          }
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
//        return $id;
        $admin = Admin::find($id);
        $admin->role()->detach();  // 从指定用户移除所有角色...
        $res = \DB::table('admin')->where(['id'=>$id])->delete();
        if($res == 1){
            return 1;
        }else{
            return 0;
        }
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
//        return dd($res);
        if($res){
            return 1;
        }else{
            return 0;
        }
//        return dd($res);
    }

    /***
     * 批量删除
     */
    public function dels(Request $request)
    {
        // 取出需要的参数
        $arr = $request->only('str');
        $str = trim($arr['str'], ','); // 去掉两边的逗号
        $arr1 = explode(',', $str);  // 将字符串转换为数组
//        return dd($arr1);
        $res = \DB::table('admin')->whereIn('id', $arr1)->delete();
        if($res){
            return 1;
        }
    }
}
