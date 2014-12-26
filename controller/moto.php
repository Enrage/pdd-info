<?php
class moto extends Core {
	public function get_content() {
		$res = $this->m->get_moto_news();
		return $res;
	}
}
?>