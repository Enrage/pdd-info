<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class update_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_menu();
		return true;
	}
	protected function update_menu_text() {
		if(isset($_GET['id_menu'])) $id_menu = (int)($_GET['id_menu']);
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->get_text_menu($id_menu);
		return $res;
	}
}
?>