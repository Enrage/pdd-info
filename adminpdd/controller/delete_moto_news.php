<?php
class delete_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_moto_news();
		return $res;
	}
}
?>