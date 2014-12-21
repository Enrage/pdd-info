<?php
class update_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_menu();
		return $res;
	}
}
?>