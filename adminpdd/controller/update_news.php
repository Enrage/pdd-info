<?php
class update_news extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
		$res = $this->m->update_news($id_news);
		return $res;
	}
}
?>