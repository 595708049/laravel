﻿@extends('admin.common.common')

@section('title')
<title>角色管理 - 管理员管理 </title>
@endsection


@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','/admin/role/create','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
			<div class="mt-10">
			<table class="table table-border table-bordered table-hover table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="6">角色管理</th>
					</tr>
					<tr class="text-c">
						{{--<th width="25"><input type="checkbox" value="" name=""></th>--}}
						<th width="40">ID</th>
						<th width="200">角色名</th>
						<th>用户列表</th>
						{{--<th width="300">描述</th>--}}
						<th width="70">操作</th>
					</tr>
				</thead>
				<tbody>
                @foreach($data as $v)
					<tr class="text-c">
						{{--<td><input type="checkbox" value="" name=""></td>--}}
						<td>{{ $v->id }}</td>
						<td>{{ $v->roleName }}</td>
						<td></td>
						{{--<td>拥有至高无上的权利</td>--}}
						<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','/admin/role/{{$v->id}}/edit','1')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'{{ $v->id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
			</div>
		</article>
	</div>
</section>
@endsection


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('js/admin/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('js/admin/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('js/admin/lib/laypage/1.2/laypage.js') }}"></script>
@section('js')
<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			url:'/admin/role/'+ id,
			type:'post',
			dataType:'json',
			data:{'id':id, '_token':'{{ csrf_token()  }}', '_method':'delete'},
			success:function(res){
			    if(res == 1){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
				}
			}
		});
		

	});
}
</script>
@endsection