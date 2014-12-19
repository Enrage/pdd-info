<h2 class="titles">Добавление авто новостей:</h2>
<p><?php
	if(isset($_SESSION['add_news']['res'])) {
		echo $_SESSION['add_news']['res'];
		unset($_SESSION['add_news']['res']);
	} ?></p>
<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="?option=add_news">Добавить новость</a></td></tr>
	<tr class="title_news_table">
		<td>Новость</td>
		<td class="del_news">Дата</td>
		<td class="del_news">Удалить?</td>
	</tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="?option=update_news&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></td>
		<td class="td_date"><?=$row['date']?></td>
		<td class="del_news"><a href="?option=delete_news&amp;id_news=<?=$row['id_news']?>">Del&nbsp;<img src="img/del.png" width="12" alt="delete"></a></td>
	</tr>
	<?php endforeach; ?>
</table>