<?php $res = $this->update_auto_news_text();?>
<section>
	<h2>Редактирование авто новости:</h2>
	<p><?php
	if(isset($_SESSION['add_auto_news']['res'])) {
		echo $_SESSION['add_auto_news']['res'];
		unset($_SESSION['add_auto_news']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Заголовок новости:<br>
		<input type="text" name="title" id="title_news" value="<?=$res['title']?>"></p>
		<input type="hidden" name="id_news" value="<?=$res['id_news']?>">
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
		<p><input type="submit" value="Сохранить" name="submit" id="submit_new"></p>
	</form>
</section>