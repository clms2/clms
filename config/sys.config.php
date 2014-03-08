<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CACHEDIR', ROOT . '/cache');

define('DEBUG', true);

if (DEBUG) {
	error_reporting(E_ALL | E_STRICT);
}

//session存放目录
$sessdir = CACHEDIR . '/session';
!is_dir($sessdir) && mkdir($sessdir, 0777, 1);
session_save_path($sessdir);
session_start();

