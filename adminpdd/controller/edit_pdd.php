<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class edit_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->edit_pdd();
		return $res;
	}
}
?>