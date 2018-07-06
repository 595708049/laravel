<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/js/admin/lib/html5.js"></script>
<script type="text/javascript" src="/js/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/js/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/js/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/js/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/js/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/js/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http:///js/admin/lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>添加管理员 - 管理员管理</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="cl pd-20">
	<form action="/admin/admin" method="post" class="form form-horizontal" id="form-admin-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="adminName">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" id="sex-1" value="1" checked>
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" value="2" name="sex">
					<label for="sex-2">女</label>
				</div>
			</div>
		</div>
		{{--<div class="row cl">--}}
			{{--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>--}}
			{{--<div class="formControls col-xs-8 col-sm-9">--}}
				{{--<input type="text" class="input-text" value="" placeholder="" id="phone" name="phone">--}}
			{{--</div>--}}
		{{--</div>--}}
		{{--<div class="row cl">--}}
			{{--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>--}}
			{{--<div class="formControls col-xs-8 col-sm-9">--}}
				{{--<input type="text" class="input-text" placeholder="@" name="email" id="email">--}}
			{{--</div>--}}
		{{--</div>--}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">角色：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="adminRole" size="1">
					@foreach($role as $v)
					<option value="{{  $v->id }}">{{ $v->roleName }}</option>
					@endforeach
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="status-1" value="1" checked>
					<label for="status-1">正常</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="status-2" value="0" name="status">
					<label for="status-2">禁用</label>
				</div>
			</div>
		</div>
		{{--<div class="row cl">--}}
			{{--<label class="form-label col-xs-4 col-sm-3">备注：</label>--}}
			{{--<div class="formControls col-xs-8 col-sm-9">--}}
				{{--<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="textarealength(this,100)"></textarea>--}}
				{{--<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>--}}
			{{--</div>--}}
		{{--</div>--}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/js/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/js/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/js/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/js/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/js/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/js/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	// $('.skin-minimal input').iCheck({
	// 	checkboxClass: 'icheckbox-blue',
	// 	radioClass: 'iradio-blue',
	// 	increaseArea: '20%'
	// });

	$("#form-admin-add").validate({
		rules:{
			adminName:{
				required:true,
				minlength:2,
				maxlength:16
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			sex:{
				required:true,
			},
			// phone:{
			// 	required:true,
			// 	isPhone:true,
			// },
			// email:{
			// 	required:true,
			// 	email:true,
			// },
			adminRole:{
				required:true,
			},
            status:{
                required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		// submitHandler:function(form){
		// 	$(form).ajaxSubmit();
		// 	var index = parent.layer.getFrameIndex(window.name);
		// 	console.log(index);
		// 	parent.$('.btn-refresh').click();
		// 	parent.layer.close(index);
		// }
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>