<?php
class update_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_news();
		return $res;
	}
}
?>