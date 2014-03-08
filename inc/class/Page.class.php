<?php
class Page {
	
	function __construct($total, $perpage, $curpage = 1, $needselect = false) {
		$this->pagenum = ceil($total/$perpage);
	}
}