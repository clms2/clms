<?php
class Mysql {
	public $link_id;
	public $debug = 0;
	public $lastsql; //最后次查询的sql语句
	protected $dbname;
	protected $pre;
	
	function __construct($dbhost, $dbuser, $dbpwd, $dbname, $pre = '', $charset = 'utf8') {
		$this->link_id = mysqli_connect($dbhost, $dbuser, $dbpwd) or die(mysqli_error());
		mysqli_select_db($this->link_id, $dbname);
		mysqli_query($this->link_id, "set names '{$charset}'");
		$this->dbname = $dbname;
		$this->pre = $pre;
	}
	
	/**
	 * 执行一条sql语句
	 *
	 * @param string $sql        	
	 * @return resource/false
	 */
	function query($sql) {
		if ($this->debug) echo $sql . '<br>';
		$this->lastsql = $sql;
		if (!($res = mysqli_query($this->link_id, $sql))) return false;
		return $res;
	}
	
	function getArr($sql, $onefield = false) {
		$ret = array ();
		$func = $onefield ? 'mysqli_fetch_row' : 'mysqli_fetch_assoc';
		if ($res = mysqli_query($this->link_id, $sql)) {
			while ( ($row = $func($res)) !== false ) {
				$ret[] = $onefield ? $row[0] : $row;
			}
		}
		return $ret;
	}
	
	/**
	 * 返回受影响记录数,insert、delete、update
	 *
	 * @param string $sql        	
	 * @return int
	 */
	function affectedRow($sql) {
		if (!$this->query($sql)) return 0;
		return mysqli_affected_rows($this->link_id);
	}
	
	/**
     * 获取一个字段值
     * @param string $table 表名
     * @param string $where
     * @param string $field 字段名
     * @return string
     */
	function getOneField($table,$field, $where = '') {
		$where = $where ? "where {$where}" : '';
		$sql = "select `{$field}` from `{$this->pre}{$table}` {$where}";
		if (!($res = $this->query($sql))) return '';
		$row = mysqli_fetch_row($res);
		return $row[0];
	}
	
	/**
     * 获取表的记录总数
     * @param string $table
     * @param string $condition
     * @return int
     */
	function getRowNum($table, $condition = '') {
		$sql = "select count(*) from {$table} {$condition}";
		if (!($res = $this->query($sql))) return 0;
		$row = mysqli_fetch_row($res);
		return isset($row[0]) ? $row[0] : 0;
	}
	
	/**
	 * 获取关联数组形式的结果集,
	 *
	 * @param string $table
	 * @param string $condition 条件,需带完整陈述，如where id=1
	 * @param string $field 需要的字段，默认全部
	 * @param string $limit 默认返回:array(0=>array([$k]=>[$v])),如果为true返回:array([$k]=>[$v])
	 * @return array
	 */
	function getAssoc($table, $condition = '', $field = '', $limit = '') {
		$field = !$field ? '*' : $this->safe_field($field);
		$sql = "select {$field} from {$table} {$condition}";
		$arr = array ();
		if (!($res = $this->query($sql))) return false;
		while ( ($rs = mysqli_fetch_assoc($res)) !== null ) {
			$arr[] = $rs;
		}
		return $limit ? (isset($arr[0]) ? $arr[0] : '') : $arr;
	}
	
	/**
     * 获取一列组成1维数组
     * @param string $table
     * @param string $condition
     * @param string $colName
     * @return string|Ambigous <string, unknown>
     */
	function getCols($table, $colName, $condition = '') {
		$sql = "select {$colName} from {$table} {$condition}";
		if (!($res = $this->query($sql))) return '';
		while ( ($row = mysqli_fetch_row($res)) !== null ) {
			$arr[] = $row[0];
		}
		return !empty($arr) ? $arr : '';
	}
	
	/**
     * 获取1条关联数组
     * @param string $table
     * @param string $where 条件,如id=1
     * @param string $field 需要的字段，默认全部
     * @return array/false
     */
	function getOneAssoc($table, $where, $field = '') {
		return $this->getAssoc($table, "where {$where} limit 1", $field, 1);
	}
	
	/**
	 * 更新数据
	 *
	 * @param 表名 $table        	
	 * @param 键值关联数组 $assoc        	
	 * @param string $where        	
	 * @return int
	 */
	function update($table, $assoc, $where = '') {
		$set = array ();
		foreach ( $assoc as $k => $v ) {
			if (is_string($v)) {
				//使用:array('field'=>'v++'),实现:set `field`=`field`+v
				if (strpos($v, '++') > 0) {
					$v = "`{$k}`+" . strtr($v, '++', '  ');
				} elseif (strpos($v, '--') > 0) {
					$v = "`{$k}`-" . strtr($v, '--', '  ');
				} else {
					$v = "'" . mysqli_real_escape_string($v, $this->link_id) . "'";
				}
			}
			$set[] = "`{$k}`=" . $v;
		}
		$set = implode(',', $set);
		$where = $where ? "where {$where}" : '';
		$sql = "update `{$table}` set {$set} {$where}";
		return $this->affectedRow($sql);
	}
	
	/**
	 * 插入一条数据
	 *
	 * @param 表 $table        	
	 * @param 键值数组 $assoc        	
	 * @return int
	 */
	function insert($table, $assoc) {
		$keys = array_keys($assoc);
		$values = array_values($assoc);
		foreach ( $keys as $k => $v ) {
			$keys[$k] = "`{$v}`";
		}
		foreach ( $values as $k => $v ) {
			if (is_string($v)) $values[$k] = "'" . mysqli_real_escape_string($v, $this->link_id) . "'";
			else $values[$k] = $v;
		}
		$keys = implode(',', $keys);
		$values = implode(',', $values);
		$sql = "insert into `{$table}`({$keys}) values({$values})";
		return $this->affectedRow($sql);
	}
	
	/**
	 * 删除记录
	 *
	 * @param 表 $table        	
	 * @param 条件 $where        	
	 * @return int
	 */
	function delete($table, $where) {
		$sql = "delete from `{$this->pre}{$table}` where {$where}";
		return $this->affectedRow($sql);
	}
	
	/**
     * 给字段加``
     * @param string $field
     * @return string
     */
	protected function safe_field($field) {
		if (!strpos($field, ',')) return "`{$field}`";
		$temp_arr = explode(',', $field);
		foreach ( $temp_arr as $k => $v ) {
			$temp_arr[$k] = "`{$v}`";
		}
		return implode(',', $temp_arr);
	}
	
	function error() {
		return addslashes(mysqli_error($this->link_id));
	}
	
	function debug() {
		$this->debug = 1;
	}
	
	function last_id() {
		return mysqli_insert_id($this->link_id);
	}
}

?>