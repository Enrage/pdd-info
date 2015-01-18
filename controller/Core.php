<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
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
		$result = $this->m->get_top_menu();
		return $result;
	}
	protected function get_rightbar() {
		$result = $this->m->get_rightbar();
		return $result;
	}
	protected function get_footer() {
		$result = $this->m->get_top_menu();
		return $result;
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