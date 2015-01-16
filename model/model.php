<?php
class model {
	public $mysqli;
	public $limit = QUANTITY_NEWS;
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
		$x = trim(strip_tags(htmlspecialchars($x)));
		return $x;
	}
	public function print_arr($arr) {
		echo '<pre>'.print_r($arr, true).'</pre>';
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
	// Top Menu
	public function get_top_menu() {
		$query = "SELECT id_menu, name_menu FROM menu";
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->execute();
			$stmt->bind_result($id_menu, $name_menu);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_menu, $name_menu);
			}
			$stmt->close();
			return $rows;
		}
	}
	// Text Top Menu
	public function get_text_menu($id_menu) {
		if(!$_GET['id_menu']) print "Неправильные данные для вывода меню";
		else {
			$id_menu = (int)$_GET['id_menu'];
			if(!$id_menu) print "Неправильные данные для вывода меню";
			else {
				$query = "SELECT * FROM menu WHERE id_menu = ?";
				if(!$stmt = $this->mysqli->prepare($query)) return false;
				else {
					$stmt->bind_param('i', $id_menu);
					$stmt->execute();
					$stmt->bind_result($id_menu, $name_menu, $text_menu, $meta_key, $meta_desc);
					$rows = array();
					while($stmt->fetch()) {
						$rows[] = array($id_menu, $name_menu, $text_menu, $meta_key, $meta_desc);
					}
					$stmt->close();
					return $rows;
				}
			}
		}
	}
	// Rightbar
	public function get_rightbar() {
		$query = "SELECT * FROM bilets";
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->execute();
			$stmt->bind_result($id, $bilet);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id, $bilet);
			}
			$stmt->close();
		}
		return $rows;
	}
	// Auto News
	public function get_auto_news() {
		$cat = 'auto';
		$cat = $this->clr($cat);
		$to = $this->to();
		$query = "SELECT id_news, cat, title, description, date, img_src FROM news WHERE cat = ? ORDER BY date DESC, id_news DESC LIMIT {$to}, {$this->limit}";
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$stmt->bind_result($id_news, $cat, $title, $description, $date, $img_src);
			$rows = array();
			while($stmt->fetch()) {
				// $rows[] = array(
				// 	'id_news' => $id_news,
				// 	'cat' => $cat,
				// 	'title' => $title,
				// 	'description' => $description,
				// 	'date' => $date,
				// 	'img_src' => $img_src);
				$rows[] = array($id_news, $cat, $title, $description, $date, $img_src);
			}
			$stmt->close();
			return $rows;
		}
	}
	// Count Auto News
	public function count_auto_news() {
		$count_auto_news = $this->mysqli->query("SELECT id_news FROM news WHERE cat = 'auto'");
		$count_auto_news = $count_auto_news->num_rows;
		return $count_auto_news;
	}
	public function get_text_auto_news($id_news) {
		$query = "SELECT id_news, title, text, meta_key, meta_desc, date FROM news WHERE cat = 'auto' AND id_news = ?";
		if(!$stmt = $this->mysqli->prepare($query)) print "Ошибка подготовки запроса";
		else {
			$stmt->bind_param('i', $id_news);
			$stmt->execute();
			$stmt->bind_result($id_news, $title, $text, $meta_key, $meta_desc, $date);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $title, $text, $meta_key, $meta_desc, $date);
			}
			$stmt->close();
			// return $row;
		}
		return $rows;
	}
	// Moto News
	public function get_moto_news() {
		$cat = 'moto';
		$cat = $this->clr($cat);
		$to = $this->to();
		$query = "SELECT id_news, cat, title, description, date, img_src FROM news WHERE cat = ? ORDER BY date DESC, id_news DESC LIMIT {$to}, {$this->limit}";
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$stmt->bind_result($id_news, $cat, $title, $description, $date, $img_src);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $cat, $title, $description, $date, $img_src);
			}
			$stmt->close();
		}
		return $rows;
	}
	// Count Moto News
	public function count_moto_news() {
		$count_moto_news = $this->mysqli->query("SELECT id_news FROM news WHERE cat = 'moto'");
		$count_moto_news = $count_moto_news->num_rows;
		return $count_moto_news;
	}
	public function get_text_moto_news($id_news) {
		$query = "SELECT id_news, title, text, meta_key, meta_desc, date FROM news WHERE cat = 'moto' AND id_news = ?";
		if(!$stmt = $this->mysqli->prepare($query)) print "Ошибка подготовки запроса";
		else {
			$stmt->bind_param('i', $id_news);
			$stmt->execute();
			$stmt->bind_result($id_news, $title, $text, $meta_key, $meta_desc, $date);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $title, $text, $meta_key, $meta_desc, $date);
			}
			$stmt->close();
		}
		return $rows;
	}
	// PDD
	public function get_pdd() {
		$to = $this->to();
		$query = "SELECT * FROM pdd ORDER BY id_pdd LIMIT {$to}, {$this->limit}";
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->execute();
			$stmt->bind_result($id_pdd, $name_pdd, $text_pdd);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_pdd, $name_pdd, $text_pdd);
			}
			$stmt->close();
		}
		return $rows;
	}
	// Count PDD
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
		if(!$stmt = $this->mysqli->prepare($query)) return false;
		else {
			$stmt->bind_param('s', $search);
			$stmt->execute();
			$stmt->bind_result($id_news, $cat, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $cat, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
			}
			if(empty($rows)) {
				$_SESSION['res'] = "По вашему запросу ничего не найдено!";
				return false;
			}
			$stmt->close();
			return $rows;
		}
	}
	public function count_search_news() {
		if(isset($_GET['search'])) $search = $this->mysqli->real_escape_string($this->clr($_GET['search']));
		$count_search = $this->mysqli->query("SELECT id_news FROM news WHERE title LIKE '%$search%'");
		$count_search = $count_search->num_rows;
		return $count_search;
	}
	// Билеты
	public function get_bilets() {
		$query = "SELECT * FROM bilets";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) return false;
		else {
			$stmt->execute();
			$stmt->bind_result($id, $bilet);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id, $bilet);
			}
			$stmt->close();
		}
		return $rows;
	}
	// Получение данных по билету
	public function get_bilet_data($id_bilet) {
		if(!$id_bilet) return;
		$query = "SELECT q.question, q.parent_bilet, a.id, a.answer, a.parent_question FROM questions q LEFT JOIN answers a ON q.id = a.parent_question WHERE q.parent_bilet = ?";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $id_bilet);
		$stmt->execute();
		$stmt->bind_result($question, $parent_bilet, $id, $answer, $parent_question);
		$data = array();
		while($stmt->fetch()) {
			$data[$parent_question][0] = $question;
			$data[$parent_question][$id] = $answer;
		}
		$stmt->close();
		return $data;
	}
	// Навигация по вопросам из билета
	public function pagination($count_questions, $res) {
		$keys = array_keys($res);
		$pagination = '<div class="paginat">';
		for($i = 1; $i <= $count_questions; $i++) {
			$key = array_shift($keys);
			if($i == 1) {
				$pagination .= '<a class="nav-active" href="#question-'.$key.'">'.$i.'</a>';
			} else {
				$pagination .= '<a href="#question-'.$key.'">'.$i.'</a>';
			}
		}
		$pagination .= '</div>';
		return $pagination;
	}
	// Получение правильных ответов
	public function get_correct_answers($test) {
		if(!$test) return false;
		$query = "SELECT q.id AS question_id, a.id AS answer_id FROM questions q LEFT JOIN answers a ON q.id = a.parent_question WHERE q.parent_bilet = ? AND a.correct_answer = '1'";
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('i', $test);
		$stmt->execute();
		$stmt->bind_result($question_id, $answer_id);
		$data = array();
		while($stmt->fetch()) {
			$data[$question_id] = $answer_id;
		}
		$stmt->close();
		return $data;
	}
	public function get_bilet_data_result($test_all_data, $result, $post) {
		$post = $_POST;
		foreach($result as $q => $a) {
			$test_all_data[$q]['correct_answer'] = $a;
			if(!isset($_POST[$q])) {
				$test_all_data[$q]['incorrect_answer'] = 0;
			}
		}
		foreach($_POST as $q => $a) {
			if(!isset($test_all_data[$q])) {
				unset($_POST[$q]);
				continue;
			}
			if(!isset($test_all_data[$q][$a])) {
				$test_all_data[$q]['incorrect_answer'] = 0;
				continue;
			}
			if($test_all_data[$q]['correct_answer'] != $a) {
				$test_all_data[$q]['incorrect_answer'] = $a;
			}
		}
		return $test_all_data;
	}
	// Вывод результатов теста
	public function print_result($test_all_data_result) {
		$all_count = count($test_all_data_result); // Кол-во вопросов
		$correct_answer_count = 0; // Кол-во верных ответов
		$incorrect_answer_count = 0; // Кол-во неверных ответов
		$percent = 0; // Процент верных ответов
		foreach($test_all_data_result as $item) {
			if(isset($item['incorrect_answer'])) $incorrect_answer_count++;
		}
		$correct_answer_count = $all_count - $incorrect_answer_count;
		$percent = round(($correct_answer_count / $all_count * 100), 2);
		if($percent < 40) return '<p class="session">Вы набрали менее 40% правильных ответов. Попробуйте еще раз</p>';
		// Вывод результатов
		$print_res = '<div class="questions">';
		$print_res .= '<div class="count-res">';
		$print_res .= "<p>Всего вопросов: <b>{$all_count}</b></p>";
		$print_res .= "<p><span style='color:green;'>Верно отвечено: </span><b>{$correct_answer_count}</b></p>";
		$print_res .= "<p><span style='color:red;'>Неверно отвечено: </span><b>{$incorrect_answer_count}</b></p>";
		$print_res .= "<p>Процент верных ответов: <b>{$percent}%</b></p>";
		$print_res .= '</div>';
		// Вывод теста
		foreach($test_all_data_result as $id_question => $item) {
			$correct_answer = $item['correct_answer'];
			$incorrect_answer = null;
			if(isset($item['incorrect_answer'])) {
				$incorrect_answer = $item['incorrect_answer'];
				$class = 'question-res error';
			} else {
				$class = 'question-res ok';
			}
			$print_res .= "<div class='$class'>";
			foreach($item as $id_answer => $answer) { // массив ответов
				if(!$id_answer) {
					$print_res .= "<p class='q'>$answer</p>";
				} elseif(is_numeric($id_answer)) {
					// ответ
					if($id_answer == $correct_answer) {
						// если это верный ответ
						$class = 'a ok2';
					} elseif($id_answer == $incorrect_answer) {
						// если это неверный ответ
						$class = 'a error2';
					} else {
						$class = 'a';
					}
					$print_res .= "<p class='$class'>$answer</p>";
				}
			}
			$print_res .= "</div>"; // .question-res
		}
		$print_res .= '</div>'; // .questions
		return $print_res;
	}
}
?>