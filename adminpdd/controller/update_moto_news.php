<?php
class update_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_moto_news();
		return $res;
	}
}
?>