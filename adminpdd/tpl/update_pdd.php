<?php
if(isset($_GET['id_pdd'])) $id_pdd = (int)($_GET['id_pdd']);
$res = $this->m->get_text_pdd($id_pdd);
?>
<section>
	<h2>Редактирование ПДД:</h2>
	<p><?php
	if(isset($_SESSION['add_pdd']['res'])) {
		echo $_SESSION['add_pdd']['res'];
		unset($_SESSION['add_pdd']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Название правила:<br>
		<input type="text" name="name_pdd" id="title_news" value="<?=$res['name_pdd']?>"></p>
		<input type="hidden" name="id_pdd" value="<?=$res['id_pdd']?>">
		<p>Текст правила:<br>
		<textarea name="text_pdd" cols="130" rows="10" id="editor1"><?=$res['text_pdd']?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p><input type="submit" value="Сохранить" name="submit" id="submit_new"></p>
	</form>
</section>