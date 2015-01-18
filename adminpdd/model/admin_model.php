<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
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
	private function clr_admin($x) {
		if(get_magic_quotes_gpc()) $x = stripslashes($x);
		$x = trim($x);
		return $x;
	}
	public function print_ar($arr) {
		echo '<pre>'.print_r($arr, true).'</pre>';
	}
	// Вывод авто новостей
	public function edit_auto_news() {
		try {
			$cat = 'auto';
			$query = "SELECT id_news, title, date FROM news WHERE cat = ?";
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare edit_auto_news", 1);
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$stmt->bind_result($id_news, $title, $date);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $title, $date);
			}
			$stmt->close();
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
	}
	// Вывод мото новостей
	public function edit_moto_news() {
		try {
			$cat = 'moto';
			$query = "SELECT id_news, title, date FROM news WHERE cat = ?";
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare edit_moto_news", 1);
			$stmt->bind_param('s', $cat);
			$stmt->execute();
			$stmt->bind_result($id_news, $title, $date);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_news, $title, $date);
			}
			$stmt->close();
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
	}
	// Вывод пдд
	public function edit_pdd() {
		try {
			$query = "SELECT id_pdd, name_pdd FROM pdd";
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare edit_pdd", 1);
			$stmt->execute();
			$stmt->bind_result($id_pdd, $name_pdd);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_pdd, $name_pdd);
			}
			$stmt->close();
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
	}
	// Вывод пунктов меню
	public function edit_menu() {
		try {
			$query = "SELECT id_menu, name_menu FROM menu";
			if(!$stmt = $this->mysqli->prepare($query)) throw new Exception("Error Prepare edit_menu", 1);
			$stmt->execute();
			$stmt->bind_result($id_menu, $name_menu);
			$rows = array();
			while($stmt->fetch()) {
				$rows[] = array($id_menu, $name_menu);
			}
			$stmt->close();
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
	}
	// Добавление авто новостей
	public function add_auto_news() {
		if($_POST) {
			$cat = 'auto';
			$title = $this->clr_admin(($_POST['title']));
			$description = $this->clr_admin(($_POST['description']));
			$text = $this->clr_admin(($_POST['text']));
			$meta_key = $this->clr_admin(($_POST['meta_key']));
			$meta_desc = $this->clr_admin(($_POST['meta_desc']));
			$date = date("Y-m-d", time());
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_auto_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_auto_news']['title'] = $title;
				$_SESSION['add_auto_news']['description'] = $description;
				$_SESSION['add_auto_news']['text'] = $text;
				$_SESSION['add_auto_news']['meta_key'] = $meta_key;
				$_SESSION['add_auto_news']['meta_desc'] = $meta_desc;
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_auto_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				$_SESSION['add_auto_news']['title'] = $title;
				$_SESSION['add_auto_news']['description'] = $description;
				$_SESSION['add_auto_news']['text'] = $text;
				$_SESSION['add_auto_news']['meta_key'] = $meta_key;
				$_SESSION['add_auto_news']['meta_desc'] = $meta_desc;
				return false;
			}
			try {
				$query = "INSERT INTO news (title, cat, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_auto_news");
				}
				$stmt->bind_param('ssssssss', $title, $cat, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_auto_news']['res'] = '<p class="success">Новость успешно добавлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_auto_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста новостей
	public function get_text_auto_news($id_news) {
		try {
			$cat = 'auto';
			$query = "SELECT id_news, title, description, text, meta_key, meta_desc, date, img_src FROM news WHERE cat = ? AND id_news = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare get_text_auto_news");
			} else {
				$stmt->bind_param('si', $cat, $id_news);
				$stmt->execute();
				$stmt->bind_result($id_news, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$rows = array();
				while($stmt->fetch()) {
					$rows[] = array($id_news, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				}
				$stmt->close();
			}
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Редактирование авто новостей
	public function update_auto_news() {
		if($_POST) {
			$cat = 'auto';
			$id_news = (int)$_POST['id_news'];
			$title = $this->clr_admin($_POST['title']);
			$description = $this->clr_admin($_POST['description']);
			$text = $this->clr_admin($_POST['text']);
			$meta_key = $this->clr_admin($_POST['meta_key']);
			$meta_desc = $this->clr_admin($_POST['meta_desc']);
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_auto_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_auto_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				return false;
			}
			try {
				$query = "UPDATE news SET title = ?, description = ?, text = ?, meta_key = ?, meta_desc = ?, img_src = ? WHERE cat = ? AND id_news = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_auto_news");
				}
				$stmt->bind_param('sssssssi', $title, $description, $text, $meta_key, $meta_desc, $img_src, $cat, $id_news);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_auto_news']['res'] = '<p class="success">Авто новость успешно обновлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_auto_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление новостей
	public function delete_auto_news($id_news) {
		try {
			$cat = 'auto';
			$query = "DELETE FROM news WHERE cat = ? AND id_news = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_auto_news");
			}
			$stmt->bind_param('si', $cat, $id_news);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_auto_news']['res'] = '<p class="success">Новость успешно удалена!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_auto_news");
			die();
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Добавление мото новостей
	public function add_moto_news() {
		if($_POST) {
			$cat = 'moto';
			$title = $this->clr_admin($_POST['title']);
			$description = $this->clr_admin($_POST['description']);
			$text = $this->clr_admin($_POST['text']);
			$meta_key = $this->clr_admin($_POST['meta_key']);
			$meta_desc = $this->clr_admin($_POST['meta_desc']);
			$date = date("Y-m-d", time());
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_moto_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_moto_news']['title'] = $title;
				$_SESSION['add_moto_news']['description'] = $description;
				$_SESSION['add_moto_news']['text'] = $text;
				$_SESSION['add_moto_news']['meta_key'] = $meta_key;
				$_SESSION['add_moto_news']['meta_desc'] = $meta_desc;
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_moto/'.$_FILES['img_src']['name']);
				$img_src = 'img_moto/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_moto_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				$_SESSION['add_moto_news']['title'] = $title;
				$_SESSION['add_moto_news']['description'] = $description;
				$_SESSION['add_moto_news']['text'] = $text;
				$_SESSION['add_moto_news']['meta_key'] = $meta_key;
				$_SESSION['add_moto_news']['meta_desc'] = $meta_desc;
				return false;
			}
			try {
				$query = "INSERT INTO news (title, cat, description, text, meta_key, meta_desc, date, img_src) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_moto_news");
				}
				$stmt->bind_param('ssssssss', $title, $cat, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_moto_news']['res'] = '<p class="success">Мото новость успешно добавлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста мото новостей
	public function get_text_moto_news($id_news) {
		try {
			$cat = 'moto';
			$query = "SELECT id_news, title, description, text, meta_key, meta_desc, date, img_src FROM news WHERE cat = ? AND id_news = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare get_text_moto_news");
			} else {
				$stmt->bind_param('si', $cat, $id_news);
				$stmt->execute();
				$stmt->bind_result($id_news, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				$rows = array();
				while($stmt->fetch()) {
					$rows[] = array($id_news, $title, $description, $text, $meta_key, $meta_desc, $date, $img_src);
				}
				$stmt->close();
			}
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Редактирование мото новостей
	public function update_moto_news() {
		if($_POST) {
			$cat = 'moto';
			$id_news = (int)$_POST['id_news'];
			$title = $this->clr_admin($_POST['title']);
			$description = $this->clr_admin($_POST['description']);
			$text = $this->clr_admin($_POST['text']);
			$meta_key = $this->clr_admin($_POST['meta_key']);
			$meta_desc = $this->clr_admin($_POST['meta_desc']);
			if(empty($title) || empty($description) || empty($text)) {
				$_SESSION['add_moto_news']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			if(!empty($_FILES['img_src']['tmp_name'])) {
				move_uploaded_file($_FILES['img_src']['tmp_name'], '../img_news/'.$_FILES['img_src']['name']);
				$img_src = 'img_news/'.$_FILES['img_src']['name'];
			} else {
				$_SESSION['add_moto_news']['res'] = '<p class="error_add">Необходимо загрузить изображение!</p>';
				return false;
			}
			try {
				$query = "UPDATE news SET title = ?, description = ?, text = ?, meta_key = ?, meta_desc = ?, img_src = ? WHERE cat = ? AND id_news = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_moto_news");
				}
				$stmt->bind_param('sssssssi', $title, $description, $text, $meta_key, $meta_desc, $img_src, $cat, $id_news);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_moto_news']['res'] = '<p class="success">Мото новость успешно обновлена!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto_news");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление мото новостей
	public function delete_moto_news($id_news) {
		try {
			$cat = 'moto';
			$query = "DELETE FROM news WHERE cat = ? AND id_news = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_moto_news");
			}
			$stmt->bind_param('si', $cat, $id_news);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_moto_news']['res'] = '<p class="success">Мото новость успешно удалена!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_moto_news");
			die();
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Добавление ПДД
	public function add_pdd() {
		if($_POST) {
			$name_pdd = $this->clr_admin($_POST['name_pdd']);
			$text_pdd = $this->clr_admin($_POST['text_pdd']);
			if(empty($name_pdd) || empty($text_pdd)) {
				$_SESSION['add_pdd']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_pdd']['name_pdd'] = $name_pdd;
				$_SESSION['add_pdd']['text_pdd'] = $text_pdd;
				return false;
			}
			try {
				$query = "INSERT INTO pdd (name_pdd, text_pdd) VALUES (?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_pdd");
				}
				$stmt->bind_param('ss', $name_pdd, $text_pdd);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_pdd']['res'] = '<p class="success">Правило успешно добавлено!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_pdd");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста ПДД
	public function get_text_pdd($id_pdd) {
		try {
			$query = "SELECT * FROM pdd WHERE id_pdd = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare get_text_pdd");
			} else {
				$stmt->bind_param('i', $id_pdd);
				$stmt->execute();
				$stmt->bind_result($id_pdd, $name_pdd, $text_pdd);
				$rows = array();
				while($stmt->fetch()) {
					$rows[] = array($id_pdd, $name_pdd, $text_pdd);
				}
				$stmt->close();
			}
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Редактирование ПДД
	public function update_pdd() {
		if($_POST) {
			$id_pdd = (int)$_POST['id_pdd'];
			$name_pdd = $this->clr_admin($_POST['name_pdd']);
			$text_pdd = $this->clr_admin($_POST['text_pdd']);
			if(empty($name_pdd) || empty($text_pdd)) {
				$_SESSION['add_pdd']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			try {
				$query = "UPDATE pdd SET name_pdd = ?, text_pdd = ? WHERE id_pdd = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_pdd");
				}
				$stmt->bind_param('ssi', $name_pdd, $text_pdd, $id_pdd);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_pdd']['res'] = '<p class="success">Правило успешно обновлено!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_pdd");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление ПДД
	public function delete_pdd() {
		try {
			$query = "DELETE FROM pdd WHERE id_pdd = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_pdd");
			}
			$stmt->bind_param('i', $id_pdd);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_pdd']['res'] = '<p class="success">Правило успешно удалено!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_pdd");
			die();
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Добавление пункта меню
	public function add_menu() {
		if($_POST) {
			$name_menu = $this->clr_admin($_POST['name_menu']);
			$text_menu = $this->clr_admin($_POST['text_menu']);
			$meta_key = $this->clr_admin($_POST['meta_key']);
			$meta_desc = $this->clr_admin($_POST['meta_desc']);
			if(empty($name_menu) || empty($text_menu)) {
				$_SESSION['add_menu']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				$_SESSION['add_menu']['name_menu'] = $name_menu;
				$_SESSION['add_menu']['text_menu'] = $text_menu;
				$_SESSION['add_menu']['meta_key'] = $meta_key;
				$_SESSION['add_menu']['meta_desc'] = $meta_desc;
				return false;
			}
			try {
				$query = "INSERT INTO menu (name_menu, text_menu, meta_key, meta_desc) VALUES (?, ?, ?, ?)";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare add_menu");
				}
				$stmt->bind_param('ssss', $name_menu, $text_menu, $meta_key, $meta_desc);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_menu']['res'] = '<p class="success">Пункт меню успешно добавлен!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_menu");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Получение текста меню
	public function get_text_menu($id_menu) {
		try {
			$query = "SELECT * FROM menu WHERE id_menu = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare get_text_menu");
			} else {
				$stmt->bind_param('i', $id_menu);
				$stmt->execute();
				$stmt->bind_result($id_menu, $name_menu, $text_menu, $meta_key, $meta_desc);
				$rows = array();
				while($stmt->fetch()) {
					$rows[] = array($id_menu, $name_menu, $text_menu, $meta_key, $meta_desc);
				}
				$stmt->close();
			}
			return $rows;
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
	// Редактирование пункта меню
	public function update_menu() {
		if($_POST) {
			$id_menu = (int)$_POST['id_menu'];
			$name_menu = $this->clr_admin($_POST['name_menu']);
			$text_menu = $this->clr_admin($_POST['text_menu']);
			$meta_key = $this->clr_admin($_POST['meta_key']);
			$meta_desc = $this->clr_admin($_POST['meta_desc']);
			if(empty($name_menu) || empty($text_menu)) {
				$_SESSION['add_menu']['res'] = '<p class="error_add">Не заполнены обязательные поля!</p>';
				return false;
			}
			try {
				$query = "UPDATE menu SET name_menu = ?, text_menu = ?, meta_key = ?, meta_desc = ? WHERE id_menu = ?";
				if(!$stmt = $this->mysqli->prepare($query)) {
					throw new Exception("Error prepare update_menu");
				}
				$stmt->bind_param('ssssi', $name_menu, $text_menu, $meta_key, $meta_desc, $id_menu);
				$stmt->execute();
				$stmt->close();
				$_SESSION['add_menu']['res'] = '<p class="success">Пункт меню успешно обновлён!</p>';
				header("Location: {$_SERVER['PHP_SELF']}?option=edit_menu");
				die();
			} catch(Exception $e) {
				print 'Ошибка: '.$e->getMessage();
				die();
			}
		}
	}
	// Удаление пункта меню
	public function delete_menu($id_menu) {
		try {
			$query = "DELETE FROM menu WHERE id_menu = ?";
			if(!$stmt = $this->mysqli->prepare($query)) {
				throw new Exception("Error prepare delete_menu");
			}
			$stmt->bind_param('i', $id_menu);
			$stmt->execute();
			$stmt->close();
			$_SESSION['add_menu']['res'] = '<p class="success">Пункт меню успешно удалён!</p>';
			header("Location: {$_SERVER['PHP_SELF']}?option=edit_menu");
			die();
		} catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
			die();
		}
	}
}
?>