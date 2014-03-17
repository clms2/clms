<?php
class Page {
	public $pagenum;
	public $pageurl;
	public $curpage;
	
	function __construct($total, $perpage, $pageurl, $curpage = 1) {
		$this->pagenum = ceil($total / $perpage);
		$this->pageurl = $pageurl;
		$this->curpage = $curpage;
	}
	
	function getPagelist($is_static = true) {
		$page = '';
		$pageurl = $is_static ? "{$this->pageurl}_[i].html" : "{$this->pageurl}?p=[i]";
		if ($this->pagenum > 8) {
			$ellipsis = true;
		}
		
		for($i = 1; $i <= $this->pagenum; $i++) {
			$in = $i == $this->curpage ? 'class="in"' : '';
			$url = str_replace('[i]', $i, $pageurl);
			$page .= "<a href='$url' {$in}>{$i}</a>";
		}
	}

}