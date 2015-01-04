<?php
class update_moto_news extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_moto_news();
		return $res;
	}
	protected function update_moto_news_text() {
		if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
		$res = $this->m->get_text_moto_news($id_news);
		return $res;
	}
}
?>