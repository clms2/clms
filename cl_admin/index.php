<?php
include_once 'check.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>您好，欢迎登陆</title>
	<link rel="stylesheet" href="css/base.css" />
	<script src="js/jq.js"></script>
</head>
<body>
	<div class="header">
		<ul class="toolbar lifl">
			<li><img src="images/icon_pwd.gif" width="17" height="17" alt="" /><a href="">修改密码</a></li>
			<li><a href="deal.php?act=logout">安全退出</a></li>
			<li class="nobg"><img src="images/icon_help.gif" width="16" height="16" alt="" /><a href="">帮助</a></li>
		</ul>
		<i></i>
		<div class="clear"></div>
		<ul class="nav_top clear lifl left" id="nav_top">
			<li class="in"><a href="main_index.php" target="main_index">首页</a></li>
			<li><a href="main_column.php" target="main_column">栏目管理</a></li>
			<li><a href="" target="main">文章管理</a></li>
		</ul>
	</div>

	<div class="main clearfix">
		<div class="nav_left left">
			
		</div>
		<div class="main_con left" id="main_con">
		</div>
		<script>
		$("#nav_top a").click(function() {
			var ifname = $(this).attr('target');
			var container = $("#main_con iframe[name="+ifname+"]");
			if(container.length == 0){
				$('<iframe src="" frameborder="0" name="'+ifname+'"></iframe>').appendTo("#main_con").siblings().hide();
			}else{
				container.show().siblings().hide();
				return false;
			}
		});
		</script>
	</div>

</body>
</html>