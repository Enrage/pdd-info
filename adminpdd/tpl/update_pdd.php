<?php $res = $this->update_pdd_text();?>
<section>
	<h2>Редактирование ПДД:</h2>
	<p><?php
	if(isset($_SESSION['add_pdd']['res'])) {
		echo $_SESSION['add_pdd']['res'];
		unset($_SESSION['add_pdd']['res']);
	} ?></p>
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<p>Название правила:<br>
		<input type="text" name="name_pdd" id="title_news" value="<?=$res[0][1]?>"></p>
		<input type="hidden" name="id_pdd" value="<?=$res[0][0]?>">
		<p>Текст правила:<br>
		<textarea name="text_pdd" cols="130" rows="10" id="editor1"><?=$res[0][2]?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace('editor1');
		</script></p>
		<p><input type="submit" value="Сохранить" name="submit" id="submit_new"></p>
	</form>
</section>