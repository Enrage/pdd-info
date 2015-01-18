<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class update_auto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_auto_news();
		return true;
	}
	protected function update_auto_news_text() {
		if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
		else die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
		$res = $this->m->get_text_auto_news($id_news);
		return $res;
	}
}
?>