<?php
class delete_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_news();
		return $res;
	}
}
?>