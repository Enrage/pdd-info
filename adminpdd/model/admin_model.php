<?php
class admin_model {
	public $mysqli;
	public function __construct() {
		try {
			$connect = $this->mysqli = new mysqli(HOST, USER, PASS, DB);
			if(!$connect) throw new Exception("Error connect");

		}
		catch(Exception $e) {
			print 'Ошибка: '.$e->getMessage();
		}
		$this->mysqli->query("SET NAMES 'UTF8'");
	}
	public function edit_news() {
		$query = "SELECT id_news, title, date FROM news";
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
	public function edit_moto() {
		$query = "SELECT id_moto, title, date FROM moto_news";
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
	public function edit_pdd() {
		$query = "SELECT id_pdd, name_pdd FROM pdd";
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
	public function edit_menu() {
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
}
?>