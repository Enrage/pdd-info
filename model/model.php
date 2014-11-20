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

	/*private $db;
	public static $mysqli = null;
	const HOST = 'localhost';
	const USER = 'pdd';
	const PASS = '12345';
	const DB = 'pdd-info';
	public function __construct() {
		try {
			$ob_mysqli = new mysqli(self::HOST, self::USER, self::PASS, self::DB);
			if(!$ob_mysqli->connect_error) {
				$this->db = $ob_mysqli;
			}
		}
		catch (Exception $e) {
			exit('Database error');
		}
	}
	public static function getObject() {
		if(self::$mysqli == null) {
			$obj = new model();
			self::$mysqli = $obj->db;
		}
		return self::$mysqli;
	}*/

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
}
?>