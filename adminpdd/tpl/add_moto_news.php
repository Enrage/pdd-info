<?php
isset($_SESSION['add_moto_news']['title']) ? $title = $_SESSION['add_moto_news']['title'] : $title = NULL;
isset($_SESSION['add_moto_news']['description']) ? $description = $_SESSION['add_moto_news']['description'] : $description = NULL;
isset($_SESSION['add_moto_news']['text']) ? $text = $_SESSION['add_moto_news']['text'] : $text = NULL;
isset($_SESSION['add_moto_news']['meta_key']) ? $meta_key = $_SESSION['add_moto_news']['meta_key'] : $meta_key = NULL;
isset($_SESSION['add_moto_news']['meta_desc']) ? $meta_desc = $_SESSION['add_moto_news']['meta_desc'] : $meta_desc = NULL;
?>
<section>
	<h2>Добавление новой мото новости:</h2>
	<p><?php
	if(isset($_SESSION['add_moto_news']['res'])) {
		echo $_SESSION['add_moto_news']['res'];
		unset($_SESSION['add_moto_news']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Заголовок мото новости:<br>
		<input type="text" name="title" id="title_news" value="<?=$title?>"></p>
		<p>Изображение:<br>
		<input type="file" name="img_src"></p>
		<p>Краткое описание мото новости:<br>
		<textarea name="description" cols="130" rows="10" id="editor1"><?=$description?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Текст мото новости:<br>
		<textarea name="text" cols="130" rows="10" id="editor2"><?=$text?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor2');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=$meta_key?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=$meta_desc?>"></p>
		<p><input type="submit" value="Добавить" name="submit" id="submit_new"></p>
	</form>
	<?php unset($_SESSION['add_moto_news']); ?>
</section>