<?php
class edit_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_moto_news();
		return $res;
	}
}
?>