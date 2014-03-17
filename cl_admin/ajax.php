<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "{$root}/config/sys.config.php";
include "{$root}/inc/func/common.func.php";
include "{$root}/config/conn.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';
if (empty($act) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') exit();

switch ($act) {
	case 'login' :
		extract($_POST);
		$user = new user($uname, $pwd);
		$ret = $user->checklogin();
		if (is_numeric($ret)) exit(strval($ret));
		$_SESSION['uname'] = $uname;
		$_SESSION['limit'] = $ret;
		exit('1');
	break;
}