<?php
class add_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_moto_news();
		return $res;
	}
}
?>