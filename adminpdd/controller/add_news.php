<?php
class add_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_news();
		return $res;
	}
}
?>