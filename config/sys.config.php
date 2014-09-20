<?php
defined('ROOT') or define('ROOT', strtr(dirname(__DIR__),'\\','/'));
define('CACHEDIR', ROOT . '/cache');
define('INC', ROOT . '/inc');
define('DEBUG', 1);

include_once INC.'/filter.php';

error_reporting(DEBUG ? E_ALL | E_STRICT : 0);

$sessdir = CACHEDIR . '/session';
!is_dir($sessdir) && mkdir($sessdir, 0777, 1);
session_save_path($sessdir);
session_start();

date_default_timezone_set('PRC');

function __autoload($class) {
	include_once INC . "/class/{$class}.class.php";
}