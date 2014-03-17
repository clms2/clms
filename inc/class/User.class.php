<?php
class user {
	public $uname;
	public $pwd;
	
	function __construct($uname = '', $pwd = '') {
		$this->uname = $uname;
		$this->pwd = $pwd;
	}
	
	/**
	 * 登陆验证
	 * @return -1:为空,0:账号密码错,否则返回权限
	 */
	function checklogin() {
		if (empty($this->uname) || empty($this->pwd)) return -1;
		global $db,$dbpre;
		$row = $db->getOneAssoc("admin a join `{$dbpre}group` b on a.gid = b.id", "uname = '{$this->uname}'", 'pwd,limit');
		if (empty($row) || $this->getpwd($this->pwd) !== $row['pwd']) return 0;
		return $row['limit'];
	}
	
	/**
	 * 加密
	 * @param string $s 未加密字串
	 * @return string 加密字串
	 */
	private function getpwd($s) {
		return str_rot13(substr(md5($s), 3, 15));
	}
}