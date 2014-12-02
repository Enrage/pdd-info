<?php
class admin_model {
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
}
?>