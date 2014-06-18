<?php
class User {
	public $uname;
	public $pwd;
	
	function __construct($uname = '', $pwd = '') {
		$this->uname = $uname;
		$this->pwd = $pwd;
	}
	
	/**
	 * 登陆验证
	 * @return 0:账号密码错|权限
	 */
	function checklogin() {
		global $db,$pre;
		$row = $db->getOneAssoc("{$pre}admin a join `{$pre}group` b on a.gid = b.id", "uname = '{$this->uname}'", 'pwd,limit,logintime');
		if (empty($row) || $this->getpwd($this->pwd) !== $row['pwd']) return 0;
		return array('limit' => $row['limit'], 'logintime' => $row['logintime']);
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