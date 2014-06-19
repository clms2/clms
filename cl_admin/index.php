<?php
include_once 'check.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>您好，<?=$_SESSION['uname']?>，欢迎登陆</title>
	<link rel="stylesheet" href="css/base.css" />
	<script src="js/jq.js"></script>
</head>
<body>
	<div class="header">
		<ul class="toolbar lifl openframe">
			<li><img src="images/icon_pwd.gif" /><a href="">修改密码</a></li>
			<li><img src="images/icon_out.png" /><a href="deal.php?act=logout">安全退出</a></li>
			<li class="nobg"><img src="images/icon_help.gif" /><a href="">问题建议</a></li>
		</ul>
		<i></i>
		<div class="clear"></div>
		<div class="nav clearfix left">
			<p class="left">上次登录：<?=date('Y-m-d H:i', $_SESSION['logintime']) ?></p>
			<div class="yj_left left"></div>
			<ul class="nav_top lifl left openframe">
				<li class="in first"><a href="main_index.php" target="main_index">首页</a></li>
				<li><a href="main_column.php" target="main_column">栏目管理</a></li>
				<li><a href="" target="main">文章管理</a></li>
			</ul>
			<div class="yj_right left"></div>
		</div>
	</div>

	<div class="main clearfix">
		<div class="nav_left left">
			<div class="op"><p>操作菜单</p></div>
			<div class="nav_con">
				<ul class="parent">
					<li class="in">
						<div class="big_tit">
							<span><img src="images/icon01.png" /></span>
							<em>文章管理</em>
							<i></i>
						</div>
						<ul class="son clear openframe">
							<li><img src="images/icon_arcadd.png" /><a href="arc_add.php" target="arc_add">添加文章</a></li>
							<li><img src="images/icon_arcadd.png" /><a href="arc_add.php" target="arc_add">添加文章</a></li>
						</ul>
					</li>
					<li>
						<div class="big_tit">
							<span><img src="images/icon01.png" /></span>
							<em>生成静态</em>
							<i></i>
						</div>
						<ul class="son clear openframe">
							<li><img src="images/icon_arcadd.png" /><a href="arc_add.php" target="arc_add">生成静态</a></li>
						</ul>
					</li>
					<!-- <li><div>文章管理</div></li>
					<li><div>生成静态</div></li>
					<li><div>系统设置</div></li> -->
				</ul>
			</div>
			<!-- nav_con end -->
		</div>
		<!-- nav_left end -->
		<div class="main_con left" id="main_con"></div>

		<script>
		//动态创建iframe，已存在则显示
		$(".openframe a").click(function() {
			$(this).parent('li').addClass('in').siblings().removeClass('in');

			var ifname = $(this).attr('target');
			var iframe = $("#main_con iframe[name="+ifname+"]");
			if(iframe.length == 0){
				$('<iframe src="" width="100%" height="100%" frameborder="0" name="'+ifname+'"></iframe>').appendTo("#main_con").siblings().hide();
			}else{
				iframe.show().siblings().hide();
				return false;
			}
		});
		</script>
	</div>
	<!-- main end -->

</body>
</html>