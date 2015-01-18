<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class pdd extends Core {
	public function get_content() {
		$res = $this->m->get_pdd();
		return $res;
	}
	protected function get_pdd_param() {
		$count_pdd = $this->m->count_pdd();
		$page = $this->m->page();
		$count_pages_pdd = ceil($count_pdd / $this->m->limit);
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page > $count_pages_pdd || $page < 1) $_SESSION['res'] = "Такой страницы не существует!";
		}
		$param[] = $page;
		$param[] = $count_pdd;
		return $param;
	}
}
?>