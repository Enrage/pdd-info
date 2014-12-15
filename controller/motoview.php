<?php
class motoview extends Core {
	public function get_content() {
		if(isset($_GET['id_moto'])) $id_moto = (int)$_GET['id_moto'];
		$res = $this->m->get_text_news($id_moto);
		return $res;
	}
}
?>