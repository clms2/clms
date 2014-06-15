<?php
/**
 * 
 * @author cw
 * @time 2014-3-23  上午9:11:50
 *
 */
$root = dirname(__DIR__);
include "{$root}/config/sys.config.php";
include "{$root}/inc/func/common.func.php";
include "{$root}/config/conn.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';
empty($act) && exit();

switch ($act) {
	case 'login' :
		extract($_POST);
		if (empty($uname) || empty($pwd)) exit('-1');
		$user = new User($uname, $pwd);
		$ret = $user->checklogin();
		if (is_numeric($ret)) exit(strval($ret));
		$db->update("{$pre}admin", array (
			'lastlogin' => '`loginip`', 
			'loginip' => $_SERVER['REMOTE_ADDR'], 
			'logintime' => time()), "uname='{$uname}'") or exit('-2');
		if ($rem == 'true') {
			setcookie(session_name(), session_id(), time() + 180 * 86400, '/');
			$_SESSION['rem'] = 1;
		}
		$_SESSION['uname'] = $uname;
		$_SESSION['limit'] = $ret;
		exit('1');
	break;
	case 'logout' :
		if(isset($_SESSION['rem'])) setcookie(session_name(), session_id(), time() - 3600, '/');
		session_unset();
		session_destroy();
		header('location:login.php');
		exit();
	break;
}