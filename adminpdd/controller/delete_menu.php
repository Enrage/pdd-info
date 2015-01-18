<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class delete_menu extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id_menu'])) $id_menu = (int)$_GET['id_menu'];
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->delete_menu($id_menu);
		return true;
	}
}
?>