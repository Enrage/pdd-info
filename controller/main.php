<?php
class main extends Core {
	public function get_content() {
		$res = $this->m->get_auto_news();
		return $res;
	}
}
?>