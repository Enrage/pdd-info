<?php
class search extends Core {
	public function get_content() {
		$res = $this->m->search();
		return $res;
	}
}
?>