<?php
class add_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_menu();
		return $res;
	}
	protected function get_add_menu() {
		isset($_SESSION['add_menu']['name_menu']) ? $name_menu = $_SESSION['add_menu']['name_menu'] : $name_menu = NULL;
		isset($_SESSION['add_menu']['text_menu']) ? $text_menu = $_SESSION['add_menu']['text_menu'] : $text_menu = NULL;
		isset($_SESSION['add_menu']['meta_key']) ? $meta_key = $_SESSION['add_menu']['meta_key'] : $meta_key = NULL;
		isset($_SESSION['add_menu']['meta_desc']) ? $meta_desc = $_SESSION['add_menu']['meta_desc'] : $meta_desc = NULL;
		$row[] = $name_menu;
		$row[] = $text_menu;
		$row[] = $meta_key;
		$row[] = $meta_desc;
		return $row;
	}
}
?>