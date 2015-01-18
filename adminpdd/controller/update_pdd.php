<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class update_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_pdd();
		return true;
	}
	protected function update_pdd_text() {
		if(isset($_GET['id_pdd'])) $id_pdd = (int)($_GET['id_pdd']);
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->get_text_pdd($id_pdd);
		return $res;
	}
}
?>