<?php
if(isset($_GET['id_menu'])) $id_menu = (int)($_GET['id_menu']);
$res = $this->m->get_text_menu($id_menu);
?>
<section>
	<h2>Редактирование пункта меню:</h2>
	<p><?php
	if(isset($_SESSION['add_menu']['res'])) {
		echo $_SESSION['add_menu']['res'];
		unset($_SESSION['add_menu']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Название пункта меню:<br>
		<input type="text" name="name_menu" id="title_news" value="<?=$res['name_menu']?>"></p>
		<input type="hidden" name="id_menu" value="<?=$res['id_menu']?>">
		<p>Текст меню:<br>
		<textarea name="text_menu" cols="130" rows="10" id="editor1"><?=$res['text_menu']?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=$res['meta_key']?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=$res['meta_desc']?>"></p>
		<p><input type="submit" value="Сохранить" name="submit" id="submit_new"></p>
	</form>
</section>