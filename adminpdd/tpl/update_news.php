<?php
if(isset($_GET['id_news'])) $id_news = (int)($_GET['id_news']);
$res = $this->m->update_news($id_news);
?>
<section>
	<p><?php
	if(isset($_SESSION['res'])) {
		echo $_SESSION['res'];
		unset($_SESSION['res']);
	} ?></p>
	<h2>Редактирование новости:</h2>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Заголовок новости:<br>
		<input type="text" name="title" id="title_news" value="<?=$res['title']?>"></p>
		<p>Изображение:<br>
		<input type="file" name="img_src"><img class="mini_img" src="../<?=$res['img_src']?>" alt="Image" width="250"></p>
		<p>Краткое описание новости:<br>
		<textarea name="description" cols="130" rows="10" id="editor1"><?=$res['description']?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Текст новости:<br>
		<textarea name="text" cols="130" rows="14" id="editor2"><?=$res['text']?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor2');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=$res['meta_key']?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=$res['meta_desc']?>"></p>
		<p><input type="submit" value="Добавить" name="submit" id="submit_new"></p>
	</form>
</section>