﻿@extends("admin.common.common")
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
@section('title')
<title>管理员列表 - 管理员列表</title>
@endsection

@section("content")
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			{{--<div class="text-c"> 日期范围：--}}
				{{--<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">--}}
				{{-----}}
				{{--<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">--}}
				{{--<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">--}}
				{{--<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>--}}
			{{--</div>--}}
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','{{ url('admin/admin/create') }}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> </span>
				<span class="r">共有数据：<strong>{{ $count }}</strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="9">员工列表</th>
					</tr>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="adminId[]" value="" id="chk"></th>
						<th width="40">ID</th>
						<th width="150">登录名</th>
						{{--<th width="90">手机</th>--}}
						{{--<th width="150">邮箱</th>--}}
						<th>角色</th>
						<th width="130">加入时间</th>
						<th width="100">是否已启用</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
                @foreach($data as $v)
					<tr class="text-c">
						<td><input type="checkbox" value="{{ $v->id }}" name="adminId[]"></td>
						<td>{{ $v->id }}</td>
						<td>{{ $v->name }}</td>
						{{--<td>13000000000</td>--}}
						{{--<td>admin@mail.com</td>--}}
						<td>{{ $v->role }}</td>
						<td>{{ date('Y-m-d H:i:s', $v->addtime) }}</td>
						@if($v->status == 1)
							<td class="td-status"><span class="label label-success radius" id="status">已启用</span></td>
						@elseif($v->status == 0)
							<td class="td-status"><span class="label label-default radius" id="status">已禁用</span></td>
						@endif
						<td class="td-manage">
						@if($v->status == 1)
							<a style="text-decoration:none" onClick="admin_stop(this, '{{ $v->id }}')" href="javascript:;" title="停用">
							<i class="Hui-iconfont">&#xe631;</i></a>
						@elseif($v->status == 0)
							<a style="text-decoration:none" onClick="admin_start(this, '{{ $v->id }}')" href="javascript:;" title="启用">
							<i class="Hui-iconfont">&#xe615;</i></a>
						@endif
							 <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','/admin/admin/{{ $v->id }}/edit','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'{{ $v->id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
                @endforeach
				</tbody>
			</table>
		    {{--<style>--}}
				{{--li a {float:left;}--}}
				{{--.pagination {--}}
					{{--width: 300px;--}}
					{{--height: 50px;--}}
					{{--margin: 0 auto;--}}
				{{--}--}}
				{{--.pagination li{--}}
					{{--float: left;--}}
					{{--height: 50px;--}}
					{{--float: left;--}}
					{{--display: block;--}}
					{{--margin:0 10px ;--}}
				{{--}--}}
				{{--.pagination li,span{--}}
					{{--float: left;--}}
					{{--display: block;--}}
				{{--}--}}
			{{--</style>--}}
		</article>
		{{ $data->links() }}
	</div>
</section>
@endsection


@section("js")
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
    // alert(id);return;
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
            url:"/admin/admin/"+id,
            type:"post",
            dataType:"json",
            data:{'id':id, '_token':'{{ csrf_token() }}', '_method':'delete'},
            success:function(data){
                if(data == 1){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
				}else{
                    return;
				}
            }
        });

	});
}
/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			url:"/admin/status",
			type:"post",
			dataType:"json",
			data:{'id':id, 'status':0, '_token':'{{ csrf_token() }}'},
			success:function(data){
				if(data == 1){
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,{{ $v->id }})" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
				}else{
				    return;
				}
			}
		});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			url:"/admin/status",
			type:"post",
			dataType:'json',
			data:{'id':id, 'status':1, '_token':'{{ csrf_token() }}'},
			success:function(data){
			    if(data == 1){
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,{{ $v->id }})" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6,time:1000});
				}else{
			        return;
				}
			}
		});
	});
}

function datadel(){
    var aa = $('input[name="adminId[]"]');
    var bb = $('input[name="adminId[]"]').length;
    // console.log(bb);
    var str = '';
    for(i=0;i<bb;i++){
		if($(aa[i]).attr('checked')){
		    // alert($(aa[i]).attr('value'));
			 str+=$(aa[i]).attr('value')+',';
		}
	}
	// str = str.substring(0, str.length-1);  // 去掉最后的字符串
	//  console.log(str);
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
			url:"/admin/dels",
			type:'post',
			dataType:'json',
			data:{'str':str, '_token':'{{ csrf_token() }}'},
			success:function(data){
			   if(data == 1){
                   layer.msg('已删除!',{icon:1,time:1000});
                   location.reload();
               }
			}
		});
	});
}

$('input[name="adminId[]"]').click(function(){
    var a = $(this).attr('checked');
	if(a != 'checked'){
	    $(this).attr('checked', 'checked');

	}else {
		$(this).removeAttr('checked');
		$('#chk').removeAttr('checked');
    }
});

$('#chk').click(function(){
    var tr = $('input[name="adminId[]"]');
    var len = $('input[name="adminId[]"]').length;
    for(i=0;i<len;i++){
        if($('#chk').is(':checked')){
            // console.log($('#chk').is(':checked'));
            $(tr[i]).attr('checked', 'checked');
		}else{
            // console.log($('#chk').is(':checked'));
            $(tr[i]).removeAttr('checked');
		}
	}
});
</script> 
@endsection