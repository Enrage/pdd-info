<?php
class delete_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_menu();
		return $res;
	}
}
?>