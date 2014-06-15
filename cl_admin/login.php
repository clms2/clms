<?php
include dirname(__DIR__).'/config/sys.config.php';
if (isset($_SESSION['limit'])){
	header('location:index.php');
	exit();
}
?>
<!DOCTYPE HTML>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="js/jq.js"></script>
	<link rel="stylesheet" href="css/base.css" />
	<link rel="stylesheet" href="css/login.css" />
	<link rel="stylesheet" href="css/ev01.css" />
	<title>您好，欢迎登陆clms内容管理系统！</title>
</head>
<body>
	<div id="bg">
		<div id="bg_h"></div>
		<div id="bg_c"></div>
		<div id="bg_f"></div>

		<div id="login_box" class="op6">
			<h1 title="用户登录">用户登录</h1>
			<div class="uname">
				用户名：
				<input type="text" id="uname" name="uname" />
			</div>
			<div class="pwd">
				密&nbsp;&nbsp;码：
				<input type="password" id="pwd" name="pwd" />
			</div>
			<div>
				<label for="rem">
					<input type="checkbox" name="remember" value="1" id="rem"> 记住我
				</label>
			</div>
			<div class="submit">
				<a href="javascript:void(0)" id="submit">登陆</a>
				<label id="msg" class="in">
					<span></span>
					<img class="hide" src="images/loading.gif" height="30"></label>
			</div>
		</div>

	</div>

	<script type="text/javascript">
	//可视化窗口高度
	var h = $(window).height();
	$("#bg").height(h);
	$("#uname").focus();

	var o_msg = $("#msg").children('span');
	var msg = function(s){
		o_msg.html(s);
	}

	$("#uname,#pwd").keyup(function(event){
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if(keyCode == 13){
			$("#submit").click();
		}
	});

	$("#submit").click(function(){
		var loading = $(this).next().children('img'), uname = $("#uname").val(), pwd = $("#pwd").val();
		if(uname == '' || pwd == '') {
			msg('请输入用户名/密码');
			return;
		}
		loading.removeClass('hide');
		o_msg.html('');
		$.ajax({
			url:'deal.php?act=login',
			timeout:5000,
			type:'post',
			data:{uname:uname,pwd:pwd,rem:$("#rem")[0].checked},
			complete:function(){
				loading.addClass('hide');
			},
			error:function(){
				msg('请求出错啦~.~');
			},
			success:function(ret){
				var ret = parseInt(ret);
				switch (ret){
					case -2:
						msg('系统错误');
					break;
					case -1:
						msg('用户名/密码不能为空')
					break;
					case 1:
						location.href = 'index.php';
					break;
					case 0:
						msg('用户名/密码错误');
					break;
					default:
						msg('未知错误');
				}
			}
		});
	});
</script>
</body>
</html>