<?php
include_once 'model/model.php';
abstract class Core {
	protected $m;
	public function __construct() {
		$this->m = new model();
	}
	protected function get_header() {
		include_once 'header.php';
	}
	protected function get_top_menu() {
		include_once 'top_menu.php';
	}
	protected function get_rightbar() {
		include_once 'rightbar.php';
	}
	protected function get_footer() {
		include_once 'footer.php';
	}
	public function get_body() {
		$this->get_header();
		$this->get_top_menu();
		$this->get_content();
		$this->get_rightbar();
		$this->get_footer();
	}
	abstract function get_content();
}
?>