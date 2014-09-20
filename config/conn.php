<?php
$config['dbhost']  = 'localhost';
$config['dbuser']  = 'root';
$config['dbpwd']   = '123456';
$config['dbname']  = 'clms';
$config['pre']     = 'cl_';
$config['charset'] = 'utf8';

class DBFactory{
	static $instance;

	static function getInstance($type, $cfg = array()){
		if(!isset($instance)){
			switch ($type) {
				case 'mysql':
					self::$instance = new Mysql($cfg);
					break;
				default:
					die('unsupport type');
			}
		}
		return self::$instance;
	}
}

$db = DBFactory::getInstance('mysql', $config);