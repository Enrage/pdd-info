<?php
class pdd extends Core {
	public function get_content() {
		$res = $this->m->get_pdd();
		return $res;
	}
}
?>