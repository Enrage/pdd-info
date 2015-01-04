<?php
class model {
	public $mysqli;
	public $limit = QUANTITY_NEWS;
	public $to = 0;
	public function __construct() {
		try {
			$connect = $this->mysqli = new mysqli(HOST, USER, PASS, DB);
			if(!$connect) throw new Exception("Error connect");

		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
		$this->mysqli->query("SET NAMES 'UTF8'");
	}
	private function clr($x) {
		if(get_magic_quotes_gpc()) $x = stripslashes($x);
		$x = trim($this->mysqli->real_escape_string(strip_tags(htmlspecialchars($x))));
		return $x;
	}
	public function page() {
		$page = 1;
		if(isset($_GET['page'])) {
			$page_num = (int)($_GET['page']);
			if($page_num > 0) {
				$page = $page_num;
			}
			else return false;
		}
		return $page;
	}
	private function to() {
		$page = $this->page();
		$to = $page * $this->limit - $this->limit;
		return $to;
	}
	// Pagination
	public function page_nav($nPage, $quantity) {
		$pages = ceil($quantity / $this->limit);
		$first = "";
		$back = "";
		$page2left = "";
		$page1left = "";
		$page = "<span>{$nPage}</span>";
		$page1right = "";
		$page2right = "";
		$forward = "";
		$last = "";
		$uri = "?";
		foreach($_GET as $key => $value) {
			if($key != 'page') $uri .= "{$key}={$value}&";
		}
		if($nPage > 3) $first = "<a href='".substr($uri, 0, -1)."' class='dark-page-nav'><<</a>";
		if($nPage > 1) $back = "<a href='".$uri."page=".($nPage - 1)."' class='dark-page-nav'>&lt;</a>";
		if(($nPage - 2) > 0) $page2left = "<a href='".$uri."page=".($nPage - 2)."' class='dark-page-nav'>".($nPage - 2)."</a>";
		if(($nPage - 1) > 0) $page1left = "<a href='".$uri."page=".($nPage - 1)."' class='dark-page-nav'>".($nPage - 1)."</a>";
		if($nPage < $pages) $page1right = "<a href='".$uri."page=".($nPage + 1)."' class='dark-page-nav'>".($nPage + 1)."</a>";
		if(($nPage + 1) < $pages) $page2right = "<a href='".$uri."page=".($nPage + 2)."' class='dark-page-nav'>".($nPage + 2)."</a>";
		if($nPage < $pages) $forward = "<a href='".$uri."page=".($nPage + 1)."' class='dark-page-nav'>&gt;</a>";
		if($nPage < ($pages - 2)) $last = "<a href='".$uri."page=".$pages."' class='dark-page-nav'>>></a>";
		return $first.$back.$page2left.$page1left.$page.$page1right.$page2right.$forward.$last;
	}
	// SQL Запрос
	private function sql_edit($query) {
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) return false;
		$stmt->execute();
		$res = $stmt->get_result();
		$stmt->close();
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
			$rows[] = $row;
		}
		if(isset($rows)) return $rows;
	}
	// Top Menu
	public function get_top_menu() {
		$edit = $this->sql_edit("SELECT id_menu, name_menu FROM menu");
		return $edit;
	}
	// Text Top Menu
	public function get_text_menu($id_menu) {
		if(!$_GET['id_menu']) print "Неправильные данные для вывода меню";
		else {
			$id_menu = (int)$_GET['id_menu'];
			if(!$id_menu) print "Неправильные данные для вывода меню";
			else {
				$query = "SELECT * FROM menu WHERE id_menu = ?";
				$stmt = $this->mysqli->stmt_init();
				if(!$stmt->prepare($query)) print "Ошибка подготовки запроса";
				else {
					$stmt->bind_param('i', $id_menu);
					$stmt->execute();
					$res = $stmt->get_result();
					$stmt->close();
					$row = $res->fetch_array(MYSQLI_ASSOC);
					return $row;
				}
			}
		}
	}
	// Rightbar
	public function get_rightbar() {
		$edit = $this->sql_edit("SELECT * FROM bilet");
		return $edit;
	}
	// Авто новости
	public function get_auto_news() {
		$cat = 'auto';
		$cat = $this->clr($cat);
		$to = $this->to();
		$query = "SELECT id_news, cat, title, description, date, img_src FROM news WHERE cat = ? ORDER BY date DESC, id_news DESC LIMIT {$to}, {$this->limit}";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$res = $stmt->get_result();
			$stmt->close();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			if(isset($rows)) return $rows;
		}
	}
	// Количество авто новостей
	public function count_auto_news() {
		$count_auto_news = $this->mysqli->query("SELECT id_news FROM news WHERE cat = 'auto'");
		$count_auto_news = $count_auto_news->num_rows;
		return $count_auto_news;
	}
	// Получение текста авто новостей
	public function get_text_auto_news($id_news) {
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		$query = "SELECT id_news, title, text, meta_key, meta_desc, date FROM news WHERE cat = 'auto' AND id_news = ?";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) print "Ошибка подготовки запроса";
		else {
			$stmt->bind_param('i', $id_news);
			$stmt->execute();
			$res = $stmt->get_result();
			$stmt->close();
			$row = $res->fetch_array(MYSQLI_ASSOC);
			return $row;
		}
	}
	// Мото новости
	public function get_moto_news() {
		$cat = 'moto';
		$cat = htmlspecialchars(trim(stripslashes($cat)));
		$to = $this->to();
		$query = "SELECT id_news, cat, title, description, date, img_src FROM news WHERE cat = ? ORDER BY date DESC, id_news DESC LIMIT {$to}, {$this->limit}";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$res = $stmt->get_result();
			$stmt->close();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			if(isset($rows)) return $rows;
		}
	}
	// Количество мото новостей
	public function count_moto_news() {
		$count_moto_news = $this->mysqli->query("SELECT id_news FROM news WHERE cat = 'moto'");
		$count_moto_news = $count_moto_news->num_rows;
		return $count_moto_news;
	}
	// Получение текста мото новостей
	public function get_text_moto_news($id_news) {
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		$query = "SELECT id_news, title, text, meta_key, meta_desc, date FROM news WHERE cat = 'moto' AND id_news = ?";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) print "Ошибка подготовки запроса";
		else {
			$stmt->bind_param('i', $id_news);
			$stmt->execute();
			$res = $stmt->get_result();
			$stmt->close();
			$row = $res->fetch_array(MYSQLI_ASSOC);
			return $row;
		}
	}
	// PDD
	public function get_pdd() {
		$to = $this->to();
		$edit = $this->sql_edit("SELECT * FROM pdd ORDER BY id_pdd LIMIT {$to}, {$this->limit}");
		return $edit;
	}
	// Количество ПДД
	public function count_pdd() {
		$count_pdd = $this->mysqli->query("SELECT id_pdd FROM pdd");
		$count_pdd = $count_pdd->num_rows;
		return $count_pdd;
	}
	// Поиск
	public function search() {
		$to = $this->to();
		if(empty($_GET['search'])) {
				$_SESSION['res'] = "Поле поиск должно быть заполнено!";
				return false;
		} else {
			$search = '%'.$this->clr($_GET['search']).'%';
			if(mb_strlen($search) < 7) {
				$_SESSION['res'] = "Слишком короткий поисковый запрос!";
				return false;
			}
		}
		$query = "SELECT * FROM news WHERE title LIKE ? ORDER BY date DESC, id_news DESC LIMIT {$to}, {$this->limit}";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $search);
			$stmt->execute();
			$res = $stmt->get_result();
			$stmt->close();
			if($res->num_rows == 0) {
				$_SESSION['res'] = "По вашему запросу ничего не найдено!";
				return false;
			}
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
		}
	}
	public function count_search_news() {
		if(isset($_GET['search'])) $search = $this->clr($_GET['search']);
		$count_search = $this->mysqli->query("SELECT id_news FROM news WHERE title LIKE '%$search%'");
		$count_search = $count_search->num_rows;
		return $count_search;
	}
}
?>