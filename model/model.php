<?php
class model {
	public $mysqli;
	public function __construct() {
		try {
		$this->mysqli = new mysqli(HOST, USER, PASS, DB);
		}
		catch(Exception $e) {
			die("Database error");
		}
		$this->mysqli->query("SET NAMES 'UTF8'");
	}
	// Top Menu
	public function get_top_menu() {
		$query = "SELECT id_menu, name_menu FROM menu";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) {
			print "Ошибка подготовки запроса";
		}
		else {
			$stmt->execute();
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
			$stmt->close();
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
				$stmt = $this->mysqli->stmt_init();
				if(!$stmt->prepare($query)) print "Ошибка подготовки запроса";
				else {
					$stmt->bind_param('i', $id_menu);
					$stmt->execute();
					$res = $stmt->get_result();
					$row = $res->fetch_array(MYSQLI_ASSOC);
					return $row;
					$stmt->close();
				}
			}
		}
	}
	// Rightbar
	public function get_rightbar() {
		$query = "SELECT * FROM bilet";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) {
			print "Ошибка подготовки запроса";
		}
		else {
			$stmt->execute();
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
			$stmt->close();
		}
	}
	// News
	public function get_news() {
		$query = "SELECT id_news, title, description, date, img_src FROM news";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) {
			print "Ошибка подготовки запроса";
		}
		else {
			$stmt->execute();
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
			$stmt->close();
		}
	}
	// Motonews
	public function get_motonews() {
		$query = "SELECT id_moto, title, description, date, img_src FROM moto_news";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) {
			print "Ошибка подготовки запроса";
		}
		else {
			$stmt->execute();
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
			$stmt->close();
		}
	}
	// PDD
	public function get_pdd() {
		$query = "SELECT * FROM pdd";
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($query)) {
			print "Ошибка подготовки запроса";
		}
		else {
			$stmt->execute();
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
			$stmt->close();
		}
	}
}
?>