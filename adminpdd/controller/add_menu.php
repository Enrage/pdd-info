<?php
class add_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_menu();
		return $res;
	}
}
?>