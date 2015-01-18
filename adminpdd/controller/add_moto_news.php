<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class add_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_moto_news();
		return true;
	}
	protected function session_moto_news() {
		isset($_SESSION['add_moto_news']['title']) ? $title = $_SESSION['add_moto_news']['title'] : $title = NULL;
		isset($_SESSION['add_moto_news']['description']) ? $description = $_SESSION['add_moto_news']['description'] : $description = NULL;
		isset($_SESSION['add_moto_news']['text']) ? $text = $_SESSION['add_moto_news']['text'] : $text = NULL;
		isset($_SESSION['add_moto_news']['meta_key']) ? $meta_key = $_SESSION['add_moto_news']['meta_key'] : $meta_key = NULL;
		isset($_SESSION['add_moto_news']['meta_desc']) ? $meta_desc = $_SESSION['add_moto_news']['meta_desc'] : $meta_desc = NULL;
		$session_moto[] = $title;
		$session_moto[] = $description;
		$session_moto[] = $text;
		$session_moto[] = $meta_key;
		$session_moto[] = $meta_desc;
		return $session_moto;
	}
}
?>