<?php
class add_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->add_pdd();
		return $res;
	}
}
?>