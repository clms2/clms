<?php
/**
 * 缓存类
 */
class CACHE {
	static $dir; //缓存存放文件夹
	static $filepath; //缓存文件完整路径
	static $checked = false; //是否已经检测过$dir存在
	static $autoclear; //是否自动清除已过期的缓存文件
	static $cachetime;
	
	/**
	 * 获取缓存
	 * @param string $cacheid
	 * @param string $is_array 数组形式的缓存文件
	 */
	static function get($cacheid, $is_array = null) {
		return isset($is_array) ? include self::$filepath : file_get_contents(self::$filepath);
	}
	
	/**
	 * 文件是否存在及有效
	 * @param string $cacheid 文件名
	 * @return bool
	 */
	static function exists($cacheid) {
		self::check($cacheid);
		if (!file_exists(self::$filepath) || self::is_expire(self::$filepath)) return false;
		return true;
	}
	
	/**
	 * 是否已过期
	 * @param string $file
	 * @return bool
	 */
	private static function is_expire($file) {
		return (time() - filemtime($file)) > self::$cachetime;
	}
	
	/**
	 * 保存文件
	 * @param string $cacheid
	 * @param string $content
	 */
	static function set($cacheid, $content) {
		self::check($cacheid);
		if (is_array($content)) {
			$content = '<?php ' . var_export($content, 1) . ';';
		}
		file_put_contents(self::$filepath, $content);
	}
	
	static private function check($cacheid) {
		if (!self::$checked) {
			self::$dir = defined('CACHEDIR') ? CACHEDIR : dirname(dirname(__FILE__)) . '/data/cache/';
			self::$cachetime = defined('CACHETIME') ? CACHETIME : 86400 * 7;
			self::$autoclear = defined('AUTOCLEAR') ? AUTOCLEAR : 1;
			self::autoclear();
			!is_dir(self::$dir) && mkdir(self::$dir, 0777, 1);
			self::$checked = true;
		}
		self::$filepath = self::$dir . $cacheid;
	}
	
	/**
	 * 清理过期文件
	 */
	static function autoclear() {
		if (!self::$autoclear) return;
		foreach ( globdir(self::$dir) as $file ) {
			self::is_expire($file) && unlink($file);
		}
	}
}