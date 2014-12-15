<?php
class menu extends Core {
	public function get_content() {
		if(isset($_GET['id_menu'])) $id_menu = (int)$_GET['id_menu'];
		$res = $this->m->get_text_menu($id_menu);
		return $res;
	}
}
?>