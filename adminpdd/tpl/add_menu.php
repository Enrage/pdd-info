<?php $res = $this->get_add_menu();?>
<section>
	<h2>Добавление пункта меню:</h2>
	<p><?php
	if(isset($_SESSION['add_menu']['res'])) {
		echo $_SESSION['add_menu']['res'];
		unset($_SESSION['add_menu']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Название пункта меню:<br>
		<input type="text" name="name_menu" id="title_news" value="<?=htmlspecialchars($res[0])?>"></p>
		<p>Текст меню:<br>
		<textarea name="text_menu" cols="130" rows="10" id="editor1"><?=$res[1]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=htmlspecialchars($res[2])?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=htmlspecialchars($res[3])?>"></p>
		<p><input type="submit" value="Добавить" name="submit" id="submit_new"></p>
	</form>
	<?php unset($_SESSION['add_menu']); ?>
</section>