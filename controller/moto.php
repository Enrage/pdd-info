<?php
class moto extends Core {
	public function get_content() {
		$res = $this->m->get_motonews();
		return $res;
	}
}
?>