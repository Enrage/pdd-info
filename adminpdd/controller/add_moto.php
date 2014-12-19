<?php
class add_moto extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_moto();
		return $res;
	}
}
?>