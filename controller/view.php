<?php
class view extends Core {
	public function get_content() {
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		if(isset($_GET['cat'])) {
			if($_GET['cat'] == 'auto') {
				$res = $this->m->get_text_auto_news($id_news);
			} elseif($_GET['cat'] == 'moto') {
				$res = $this->m->get_text_moto_news($id_news);
			}
		}
		return $res;
	}
}
?>