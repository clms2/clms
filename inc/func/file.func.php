<?php
/**
 * 遍历目录 >=5.3
 * @param string $dir 绝对/相对路径
 * @param string $filter 默认*返回所有文件及文件夹，*.php仅返回php文件，如果$patten为GLOB_BRACE可实现多文件筛选，如*.{php,html}，返回php和html文件
 * @param const $patten 默认GLOB_BRACE，可选:GLOB_ONLYDIR，更多参数请参考手册
 * @param string/bool $nocache 防止本次调用的结果缓存上次的结果，如果一个脚本仅调用一次本函数，则不用管，否则得设个值
 * @return array
 */
function globdir($dir, $filter = '*', $patten = GLOB_BRACE, $nocache = null) {
	static $file_arr = array ();
	isset($nocache) && $file_arr = array ();
	if (!is_dir($dir)) return;
	$a = glob("{$dir}/{$filter}", $patten);
	array_walk($a, function ($file) use(&$file_arr, $patten, $filter) {
		if ($patten == GLOB_ONLYDIR) {
			$file_arr[] = $file;
			globdir($file, '*', GLOB_ONLYDIR);
		} else {
			is_file($file) ? $file_arr[] = $file : globdir($file, $filter, $patten);
		}
	});
	if ($filter != '*') {
		$b = glob("{$dir}/*", GLOB_ONLYDIR);
		array_walk($b, function ($dir) use($filter, $patten) {
			globdir($dir, $filter, $patten);
		});
	}
	return $file_arr;
}