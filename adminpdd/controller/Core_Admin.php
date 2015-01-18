<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
include_once 'model/admin_model.php';
abstract class Core_Admin {
	protected $m;
	public function __construct() {
		$this->m = new admin_model();
	}
	protected function get_header() {
		return true;
	}
	protected function get_leftbar() {
		return true;
	}
	protected function get_footer() {
		return true;
	}
	public function get_body($tpl) {
		$header = $this->get_header();
		$leftbar = $this->get_leftbar();
		$content = $this->get_content();
		$footer = $this->get_footer();
		include 'tpl/index.php';
	}
	abstract function get_content();
}
?>