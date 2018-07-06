<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = \DB::table('role')->get();
//        dd($data);
        return view('admin.role.list', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        $data = $request->only('roleName');
//        dd($data);
        $res = \DB::table('role')->where('roleName', '=', $data['roleName'])->count();
        if($res>0){
            return view('admin.success')->with([
                'message'=>'角色名已经存在！',
                'url' => url('admin/role/create'),
                'jumpTime'=>3,
            ]);
        }
        if(\DB::table('role')->insert($data)){
            return view('admin.success')->with([
                'message'=>'角色添加成功！',
                'url' => url('admin/role/create'),
                'jumpTime'=>3,
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = \DB::table('role')->where(['id'=>$id])->get();
//        dd($data[0]);
        return view('admin.role.edit', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
//        dd($request->all());
        $role_name = $request->only('roleName');
//        dd($role_name);
        $data = \DB::table('role')->where('id','<>',$id)->pluck('roleName')->toArray();
//         dd($data);
        if(in_array($role_name['roleName'], $data)){
            return view('admin.success')->with([
                'message'=>'角色名存在！',
                'url' => url('admin/role/'. $id .'/edit'),
                'jumpTime'=>3,
            ]);
        }
        $res = \Db::table('role')->where(['id'=>$id])->update($role_name);
        if($res){
            return view('admin.success')->with([
                'message'=>'角色修改成功！',
                'url' => url('admin/role'),
                'jumpTime'=>3,
            ]);
        }else{
            echo 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        \DB::table('role')->where('id', '=', $id)->delete();
        return 1;
    }
}
