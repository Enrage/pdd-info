<?php
include_once 'model/model.php';
abstract class Core {
	protected $m;
	public function __construct() {
		$this->m = new model();
	}
	protected function get_header() {
		return true;
	}
	protected function get_top_menu() {
		return true;
	}
	protected function get_rightbar() {
		return true;
	}
	protected function get_footer() {
		return true;
	}
	public function get_body($tpl) {
		$header = $this->get_header();
		$top_menu = $this->get_top_menu();
		$content = $this->get_content();
		$rightbar = $this->get_rightbar();
		$footer = $this->get_footer();
		include 'tpl/index.php';
	}
	abstract function get_content();
}
?>