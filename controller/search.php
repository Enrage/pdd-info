<?php
class search extends Core {
	public function get_content() {
		$res = $this->m->search();
		return $res;
	}
	protected function get_search_param() {
		$count_search_news = $this->m->count_search_news();
		$page = $this->m->page();
		$count_pages_search_news = ceil($count_search_news / $this->m->limit);
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page > $count_pages_search_news || $page < 1) $_SESSION['res'] = "Такой страницы не существует!";
		}
		$param[] = $page;
		$param[] = $count_search_news;
		return $param;
	}
}
?>