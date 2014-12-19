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
				$_SESSION['add_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_news']['title'] = $title;
				$_SESSION['add_news']['description'] = $description;
				$_SESSION['add_news']['text'] = $text;
				$_SESSION['add_news']['meta_key'] = $meta_key;
				$_SESSION['add_news']['meta_desc'] = $meta_desc;
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				$_SESSION['add_news']['title'] = $title;
				$_SESSION['add_news']['description'] = $description;
				$_SESSION['add_news']['text'] = $text;
				$_SESSION['add_news']['meta_key'] = $meta_key;
				$_SESSION['add_news']['meta_desc'] = $meta_desc;
				return false;
			}
			try {
				$query = "INSERT INTO news (title, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_news");
				}
				$stmt->bind_param('sssssss', $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_news']['res'] = '<p class="success">Новость успешно добавлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста новостей
	public function get_text_news($id_news) {
		try {
			if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
			$query = "SELECT id_news, title, description, text, meta_key, meta_desc, date, img_src FROM news WHERE id_news = ?";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare get_text_news");
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
	// Редактирование авто новостей
	public function update_news() {
		if($_POST) {
			$id_news = (int)$_POST['id_news'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$text = $_POST['text'];
			$meta_key = $_POST['meta_key'];
			$meta_desc = $_POST['meta_desc'];
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				return false;
			}
			try {
				$query = "UPDATE news SET title = ?, description = ?, text = ?, meta_key = ?, meta_desc = ?, img_src = ? WHERE id_news = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_news");
				}
				$stmt->bind_param('ssssssi', $title, $description, $text, $meta_key, $meta_desc, $img_src, $id_news);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_news']['res'] = '<p class="success">Новость успешно обновлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление новостей
	public function delete_news() {
		try {
			if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
			$query = "DELETE FROM news WHERE id_news = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_news");
			}
			$stmt->bind_param('i', $id_news);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_news']['res'] = '<p class="success">Новость успешно удалена!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_news");
			die();
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
				$_SESSION['add_moto']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_moto']['title'] = $title;
				$_SESSION['add_moto']['description'] = $description;
				$_SESSION['add_moto']['text'] = $text;
				$_SESSION['add_moto']['meta_key'] = $meta_key;
				$_SESSION['add_moto']['meta_desc'] = $meta_desc;
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_moto/'.$_FILES['img_src']['name']);
				$img_src = 'img_moto/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_moto']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				$_SESSION['add_moto']['title'] = $title;
				$_SESSION['add_moto']['description'] = $description;
				$_SESSION['add_moto']['text'] = $text;
				$_SESSION['add_moto']['meta_key'] = $meta_key;
				$_SESSION['add_moto']['meta_desc'] = $meta_desc;
				return false;
			}
			try {
				$query = "INSERT INTO moto_news (title, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_moto");
				}
				$stmt->bind_param('sssssss', $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_moto']['res'] = '<p class="success">Мото новость успешно добавлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста мото новостей
	public function get_text_motonews($id_moto) {
		try {
			if(isset($_GET['id_moto'])) $id_moto = (int)($_GET['id_moto']);
			$query = "SELECT id_moto, title, description, text, meta_key, meta_desc, date, img_src FROM moto_news WHERE id_moto = ?";
			$stmt = $this->mysqli->stmt_init();
			if(!$stmt->prepare($query)) {
				throw new Exception("Error prepare get_text_motonews");
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
	// Редактирование мото новостей
	public function update_moto() {
		if($_POST) {
			$id_moto = (int)$_POST['id_moto'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$text = $_POST['text'];
			$meta_key = $_POST['meta_key'];
			$meta_desc = $_POST['meta_desc'];
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_moto']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_moto']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				return false;
			}
			try {
				$query = "UPDATE moto_news SET title = ?, description = ?, text = ?, meta_key = ?, meta_desc = ?, img_src = ? WHERE id_moto = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_moto");
				}
				$stmt->bind_param('ssssssi', $title, $description, $text, $meta_key, $meta_desc, $img_src, $id_moto);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_moto']['res'] = '<p class="success">Мото новость успешно обновлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление мото новостей
	public function delete_moto() {
		try {
			if(isset($_GET['id_moto'])) $id_moto = (int)($_GET['id_moto']);
			$query = "DELETE FROM moto_news WHERE id_moto = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_news");
			}
			$stmt->bind_param('i', $id_moto);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_moto']['res'] = '<p class="success">Мото новость успешно удалена!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto");
			die();
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
}
?>