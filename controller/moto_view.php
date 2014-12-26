<?php
class moto_view extends Core {
	public function get_content() {
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		$res = $this->m->get_text_moto_news($id_news);
		return $res;
	}
}
?>