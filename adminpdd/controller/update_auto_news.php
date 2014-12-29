<?php
class update_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_auto_news();
		return $res;
	}
}
?>