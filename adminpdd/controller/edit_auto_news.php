<?php
class edit_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_auto_news();
		return $res;
	}
}
?>