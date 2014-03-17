<?php
/**
 * Captcha类文件
 * Captcha类文件是一个生成验证码的类文件
 * @author pan <panxuzhengxuxin@gmail.com>
 * @package demo05
 * @since 1.0
 */
/**
 * Captcha类文件是一个生成验证码的类文件,用于生成验证码
 *
 */
class Captcha {
	private $im;
	private $width;
	private $height;
	private $codenum;
	private $charcode;
	
	function __construct($width = 130, $height = 45, $codenum = 4, $charcode = '') {
		$this->width = $width;
		$this->height = $height;
		$this->codenum = $codenum;
		$this->charcode = $charcode;
	}
	
	/**
	 * 创建图片
	 */
	private function createImage() {
		$this->im = imagecreatetruecolor($this->width, $this->height);
		$bgColor = imagecolorallocate($this->im, 255, 255, 255);
		imagefill($this->im, 0, 0, $bgColor);
	
	}
	/**
	 * 生成验证码
	 *
	 *
	 */
	private function createCode() {
		$dic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$len = strlen($dic);
		for($i = 0; $i < $this->codenum; $i++) {
			$start = rand(0, $len);
			$code = substr($dic, $start, 1);
			$this->charcode .= $code;
		}
	
	}
	
	/**
	 * 返回生成的验证码
	 * @return $charcode 验证码
	 */
	public function getCode() {
		return $this->charcode;
	}
	
	/**
	 * 将验证码写到图片上
	 */
	private function writeText() {
		//将字符逐个写入图片
		for($i = 0; $i < $this->codenum; $i++) {
			//字符颜色
			$color = imagecolorallocate($this->im, rand(0, 128), rand(0, 128), rand(0, 128));
			//字符之间的步长
			$step = floor(($this->width - 10) / $this->codenum);
			//x坐标
			$x = $i * $step + rand(0, 20);
			//y坐标
			$y = rand(15, 25);
			//字符
			$char = substr($this->charcode, $i, 1);
			//将字符写入图片
			imagestring($this->im, 5, $x, $y, $char, $color);
		}
	
	}
	
	/**
	 * createCapcha生成验证码图片
	 * @return .png格式的验证码图片
	 */
	public function createCapcha() {
		//创建图片
		$this->createImage();
		//创建验证码
		$this->createCode();
		//将验证码写到图片上
		$this->writeText();
		//向浏览器输出图片
		imagepng($this->im);
	}
}
