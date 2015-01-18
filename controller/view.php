<?php
defined('PDD') or die("<p style='color:#700;font:16px Roboto, Tahoma;'>Access Denied</p>");
class view extends Core {
	public function get_content() {
		$res = '';
		if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
		else die ("<p style='color:#900;font:16px Roboto, Tahoma;'>Access Denied</p>");
		if(isset($_GET['cat'])) {
			if($_GET['cat'] == 'auto') {
				$res = $this->m->get_text_auto_news($id_news);
			} elseif($_GET['cat'] == 'moto') {
				$res = $this->m->get_text_moto_news($id_news);
			} else die("<p style='color:#900;font:16px Roboto, Tahoma;'>Access Denied</p>");
		}
		else {
			die("<p style='color:#900;font:16px Roboto, Tahoma;'>Access Denied</p>");
		}
		return $res;
	}
}
?>