<?php
class delete_moto extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_moto();
		return $res;
	}
}
?>