<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class delete_pdd extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id_pdd'])) $id_pdd = (int)($_GET['id_pdd']);
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->delete_pdd($id_pdd);
		return true;
	}
}
?>