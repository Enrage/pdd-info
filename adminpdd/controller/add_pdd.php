<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class add_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_pdd();
		return true;
	}
	protected function session_pdd() {
		isset($_SESSION['add_pdd']['name_pdd']) ? $name_pdd = $_SESSION['add_pdd']['name_pdd'] : $name_pdd = NULL;
		isset($_SESSION['add_pdd']['text_pdd']) ? $text_pdd = $_SESSION['add_pdd']['text_pdd'] : $text_pdd = NULL;
		$session_pdd[] = $name_pdd;
		$session_pdd[] = $text_pdd;
		return $session_pdd;
	}
}
?>