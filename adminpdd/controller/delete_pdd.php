<?php
class delete_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->delete_pdd();
		return $res;
	}
}
?>