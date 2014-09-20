<?php
interface IMysql{
	/**
	 * 建立数据库连接
	 * @param array $cfg array('dbhost'=>,'dbuser'=>,'dbpwd'=>,'dbname'=>,'pre'=>,'charset'=>);
	 */
	function __construct($cfg);

	/**
	 * 执行一条sql语句
	 *
	 * @param string $sql        	
	 * @return resource/false
	 */
	function query($sql);

	/**
	 * 返回数组
	 * @param  string  $sql      
	 * @param  boolean $onefield 是否返回第一个字段
	 * @return array            结果数组
	 */
	function getArr($sql, $onefield = false);

	/**
	 * 返回受影响记录数,insert、delete、update
	 *
	 * @param string $sql        	
	 * @return int
	 */
	function affectedRow($sql);

	/**
     * 获取一个字段值
     * @param string $table 表名
     * @param string $field 字段名
     * @param string $where
     * @return string
     */
	function getOneField($table, $field, $where = '');

	/**
     * 获取表的记录总数
     * @param string $table
     * @param string $where 筛选条件
     * @return int
     */
	function getRowNum($table, $where = '');

	/**
     * 获取一列组成1维数组
     * @param string $table
     * @param string $colName
     * @param string $where
     * @return array/'' 
     */
	function getCols($table, $colName, $where = '');

	/**
	 * 获取关联数组形式的结果集,
	 *
	 * @param string $table
	 * @param string $where 
	 * @param string $field 需要的字段，默认全部
	 * @param string $limit 默认返回:array(0=>array([$k]=>[$v])),如果为true返回:array([$k]=>[$v]),也可以用getOneAssoc
	 * @return array
	 */
	function getAssoc($table, $where = '', $field = '', $limit = '');

	function getOneAssoc($table, $where, $field = '');

	/**
	 * 更新数据
	 * @param  stirng $table 
	 * @param  array $assoc 键值关联数组(字段=>值), 值可传++/--，如'1++',实现字段加1
	 * @param  string $where 
	 * @return int        受影响记录数
	 */
	function update($table, $assoc, $where = '');

	/**
	 * 插入一条数据
	 * @param  string $table
	 * @param  array $assoc 键值数组(字段=>值)
	 * @return int        1/0
	 */
	function insert($table, $assoc);

	/**
	 * 删除记录
	 * @param  string $table 
	 * @param  string $where 
	 * @return int
	 */
	function delete($table, $where);

	/**
     * 给字段加``
     * @param string $field
     * @return string
     */
	function safe_field($field);

}