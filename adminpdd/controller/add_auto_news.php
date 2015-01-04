<?php
class add_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_auto_news();
		return $res;
	}
	protected function session_auto_news() {
		isset($_SESSION['add_auto_news']['title']) ? $title = $_SESSION['add_auto_news']['title'] : $title = NULL;
		isset($_SESSION['add_auto_news']['description']) ? $description = $_SESSION['add_auto_news']['description'] : $description = NULL;
		isset($_SESSION['add_auto_news']['text']) ? $text = $_SESSION['add_auto_news']['text'] : $text = NULL;
		isset($_SESSION['add_auto_news']['meta_key']) ? $meta_key = $_SESSION['add_auto_news']['meta_key'] : $meta_key = NULL;
		isset($_SESSION['add_auto_news']['meta_desc']) ? $meta_desc = $_SESSION['add_auto_news']['meta_desc'] : $meta_desc = NULL;
		$session_auto[] = $title;
		$session_auto[] = $description;
		$session_auto[] = $text;
		$session_auto[] = $meta_key;
		$session_auto[] = $meta_desc;
		return $session_auto;
	}
}
?>


