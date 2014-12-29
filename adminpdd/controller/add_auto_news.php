<?php
class add_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_auto_news();
		return $res;
	}
}
?>


