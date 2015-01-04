<?php $res = $this->session_auto_news();?>
<section>
	<h2>Добавление новой новости:</h2>
	<p><?php
	if(isset($_SESSION['add_auto_news']['res'])) {
		echo $_SESSION['add_auto_news']['res'];
		unset($_SESSION['add_auto_news']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Заголовок новости:<br>
		<input type="text" name="title" id="title_news" value="<?=htmlspecialchars($res[0])?>"></p>
		<p>Изображение:<br>
		<input type="file" name="img_src"></p>
		<p>Краткое описание новости:<br>
		<textarea name="description" cols="130" rows="10" id="editor1"><?=$res[1]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Текст новости:<br>
		<textarea name="text" cols="130" rows="10" id="editor2"><?=$res[2]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor2');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=htmlspecialchars($res[3])?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=htmlspecialchars($res[4])?>"></p>
		<p><input type="submit" value="Добавить" name="submit" id="submit_new"></p>
	</form>
	<?php unset($_SESSION['add_auto_news']); ?>
</section>