<?php
class update_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_pdd();
		return $res;
	}
}
?>