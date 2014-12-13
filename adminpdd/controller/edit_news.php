<?php
class edit_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_news();
		return $res;
	}
}
?>