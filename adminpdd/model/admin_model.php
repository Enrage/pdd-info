<?php
class admin_model {
	public $mysqli;
	public function __construct() {
		try {
			$connect = $this->mysqli = new mysqli(HOST, USER, PASS, DB);
			if(!$connect) throw new Exception("Error connect Database");
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
		$this->mysqli->query("SET NAMES 'UTF8'");
	}
	// Вывод авто новостей
	public function edit_news() {
		try {
			$query = "SELECT id_news, title, date FROM news";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare edit_news");
			} else {
				$stmt->execute();
				$res = $stmt->get_result();
				while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
				return $rows;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Вывод мото новостей
	public function edit_moto() {
		try {
			$query = "SELECT id_moto, title, date FROM moto_news";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare edit_moto");
			} else {
				$stmt->execute();
				$res = $stmt->get_result();
				while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
				return $rows;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Вывод пдд
	public function edit_pdd() {
		try {
			$query = "SELECT id_pdd, name_pdd FROM pdd";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare edit_pdd");
			} else {
				$stmt->execute();
				$res = $stmt->get_result();
				while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
				return $rows;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Вывод пунктов меню
	public function edit_menu() {
		try {
			$query = "SELECT id_menu, name_menu FROM menu";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare edit_menu");
			} else {
				$stmt->execute();
				$res = $stmt->get_result();
				while($row = $res->fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
				return $rows;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Добавление авто новостей
	public function add_news() {
		if($_POST) {
			$title = $_POST['title'];
			$description = $_POST['description'];
			$text = $_POST['text'];
			$meta_key = $_POST['meta_key'];
			$meta_desc = $_POST['meta_desc'];
			$date = date("Y-m-d", time());
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=add_news");
				die();
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else $_SESSION['res'] = '<p class="error_add">Необходимо загрузить изображение</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=add_news");
				die();
			try {
				$query = "INSERT INTO news (title, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_news");
				}
				$stmt->bind_param('sssssss', $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Редактирование авто новостей
	public function update_news($id_news) {
		try {
			$query = "SELECT id_news, title, description, text, meta_key, meta_desc, date, img_src FROM news WHERE id_news = ?";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare update_news");
			} else {
				$stmt->bind_param('i', $id_news);
				$stmt->execute();
				$res = $stmt->get_result();
				$row = $res->fetch_array(MYSQLI_ASSOC);
				return $row;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Добавление мото новостей
	public function add_moto() {
		if($_POST) {
			$title = $_POST['title'];
			$description = $_POST['description'];
			$text = $_POST['text'];
			$meta_key = $_POST['meta_key'];
			$meta_desc = $_POST['meta_desc'];
			$date = date("Y-m-d", time());
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=add_moto");
				die();
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_moto/'.$_FILES['img_src']['name']);
				$img_src = 'img_moto/'.$_FILES['img_src']['name'];
			} else $_SESSION['res'] = '<p class="error_add">Необходимо загрузить изображение</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=add_moto");
				die();
			try {
				$query = "INSERT INTO moto_news (title, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_moto");
				}
				$stmt->bind_param('sssssss', $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Редактирование мото новостей
	public function update_moto($id_moto) {
		try {
			$query = "SELECT id_moto, title, description, text, meta_key, meta_desc, date, img_src FROM moto_news WHERE id_moto = ?";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare update_moto");
			} else {
				$stmt->bind_param('i', $id_moto);
				$stmt->execute();
				$res = $stmt->get_result();
				$row = $res->fetch_array(MYSQLI_ASSOC);
				return $row;
				$stmt->close();
			}
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
}
?>