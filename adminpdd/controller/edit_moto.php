<?php
class edit_moto extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_moto();
		return $res;
	}
}
?>