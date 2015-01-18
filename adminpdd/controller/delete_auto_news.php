<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class delete_auto_news extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->delete_auto_news($id_news);
		return true;
	}
}
?>