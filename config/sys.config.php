<?php
defined('ROOT') or define('ROOT', strtr(dirname(__DIR__),'\\','/'));
define('CACHEDIR', ROOT . '/cache');
define('DEBUG', true);

if (DEBUG) {
	error_reporting(E_ALL | E_STRICT);
}

$sessdir = CACHEDIR . '/session';
!is_dir($sessdir) && mkdir($sessdir, 0777, 1);
session_save_path($sessdir);
session_start();

function __autoload($class) {
	include_once ROOT . "/inc/class/{$class}.class.php";
}