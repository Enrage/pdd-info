<?php
class update_moto extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_moto();
		return $res;
	}
}
?>