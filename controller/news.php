<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class news extends Core {
	public function get_content() {
		$res = $this->m->get_auto_news();
		return $res;
	}
	protected function get_auto_param() {
		$count_auto_news = $this->m->count_auto_news();
		$page = $this->m->page();
		$count_pages_auto_news = ceil($count_auto_news / $this->m->limit);
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page > $count_pages_auto_news || $page < 1) $_SESSION['res'] = "Такой страницы не существует!";
		}
		$param[] = $page;
		$param[] = $count_auto_news;
		return $param;
	}
	pa
}
?>