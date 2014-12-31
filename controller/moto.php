<?php
class moto extends Core {
	public function get_content() {
		$res = $this->m->get_moto_news();
		return $res;
	}
	protected function get_moto_param() {
		$count_moto_news = $this->m->count_moto_news();
		$page = $this->m->page();
		$count_pages_moto_news = ceil($count_moto_news / $this->m->limit);
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page > $count_pages_moto_news || $page < 1) $_SESSION['res'] = "Такой страницы не существует!";
		}
		$param[] = $page;
		$param[] = $count_moto_news;
		return $param;
	}
}
?>