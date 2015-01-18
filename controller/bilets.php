<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class bilets extends Core {
	public function get_content() {
		$res = $this->m->get_bilets();
		return $res;
	}
}
?>