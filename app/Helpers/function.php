<?php
function get_admin_name($id){
    $name = DB::table('admin')->leftJoin('role', 'admin.role', '=', 'role.id')
            ->where(['admin.id'=>$id])->value('role.roleName');
   // dd($name);
    return $name;
}