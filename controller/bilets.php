<?php
class bilets extends Core {
	public function get_content() {
		$res = $this->m->get_bilets();
		return $res;
	}
}
?>