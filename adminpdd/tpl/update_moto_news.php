<?php $res = $this->update_moto_news_text();?>
<section>
	<h2>Редактирование мото новости:</h2>
	<p><?php
	if(isset($_SESSION['add_moto_news']['res'])) {
		echo $_SESSION['add_moto_news']['res'];
		unset($_SESSION['add_moto_news']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Заголовок мото новости:<br>
		<input type="text" name="title" id="title_news" value="<?=$res[0][1]?>"></p>
		<input type="hidden" name="id_news" value="<?=$res[0][0]?>">
		<p>Изображение:<br>
		<input type="file" name="img_src"><img class="mini_img" src="../<?=$res[0][7]?>" alt="Image" width="250"></p>
		<p>Краткое описание мото новости:<br>
		<textarea name="description" cols="130" rows="10" id="editor1"><?=$res[0][2]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p>Текст мото новости:<br>
		<textarea name="text" cols="130" rows="14" id="editor2"><?=$res[0][3]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor2');
		</script></p>
		<p>Meta ключевые слова:<br>
		<input type="text" name="meta_key" id="keywords_news" value="<?=$res[0][4]?>"></p>
		<p>Meta описание:<br>
		<input type="text" name="meta_desc" id="description_news" value="<?=$res[0][5]?>"></p>
		<p><input type="submit" value="Сохранить" name="submit" id="submit_new"></p>
	</form>
</section>