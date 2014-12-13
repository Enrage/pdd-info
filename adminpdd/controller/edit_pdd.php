<?php
class edit_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_pdd();
		return $res;
	}
}
?>