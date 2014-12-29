<?php
class delete_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_auto_news();
		return $res;
	}
}
?>