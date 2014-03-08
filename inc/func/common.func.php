<?php
function __autoload($class) {
	include_once ROOT . "/inc/class/{$class}.class.php";
}