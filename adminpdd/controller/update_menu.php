<?php
class update_menu extends Core_Admin {
	public function get_content() {
		$res = $this->m->update_menu();
		return $res;
	}
	protected function update_menu_text() {
		if(isset($_GET['id_menu'])) $id_menu = (int)($_GET['id_menu']);
		$res = $this->m->get_text_menu($id_menu);
		return $res;
	}
}
?>