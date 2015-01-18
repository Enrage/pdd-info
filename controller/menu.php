<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class menu extends Core {
	public function get_content() {
		if(isset($_GET['id_menu'])) $id_menu = (int)$_GET['id_menu'];
		$res = $this->m->get_text_menu($id_menu);
		return $res;
	}
}
?>