<?php
class update_pdd extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_pdd();
		return $res;
	}
	protected function update_pdd_text() {
		if(isset($_GET['id_pdd'])) $id_pdd = (int)($_GET['id_pdd']);
		$res = $this->m->get_text_pdd($id_pdd);
		return $res;
	}
}
?>