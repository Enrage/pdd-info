<?php
class bilet extends Core {
	public function get_content() {
		if(isset($_GET['id_bilet'])) $id_bilet = (int)$_GET['id_bilet'];
		else $id_bilet = 1;
		$res = $this->m->get_bilet_data($id_bilet);
		return $res;
	}
	protected function nav() {
		if(isset($_GET['id_bilet'])) $id_bilet = (int)$_GET['id_bilet'];
		else $id_bilet = 1;
		$res = $this->m->get_bilet_data($id_bilet);
		if(is_array($res)) $count_questions = count($res);
		$pagination = $this->m->pagination($count_questions, $res);
		return $pagination;
	}
	public function get_post() {
		if(isset($_POST['test'])) {
			$test = (int)$_POST['test'];
			unset($_POST['test']);
			$result = $this->m->get_correct_answers($test);
			if(!is_array($result)) die('Ошибка');
			// данные теста
			$test_all_data = $this->m->get_bilet_data($test);
			$test_all_data_result = $this->m->get_bilet_data_result($test_all_data, $result, $_POST);
			print $this->m->print_result($test_all_data_result);
			die;
		}
	}
}
?>