<?php
class edit_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_menu();
		return $res;
	}
}
?>