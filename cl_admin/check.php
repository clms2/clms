<?php
/**
 *是否登录
 *@author cw
 *@time 2014-3-13  下午8:38:57
 *
 */
include_once "{$_SERVER['DOCUMENT_ROOT']}/config/sys.config.php";

if (!isset($_SESSION['limit'])) {
	header('location:login.php');
	exit();
}