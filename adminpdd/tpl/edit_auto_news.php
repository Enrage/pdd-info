<h2 class="titles">Добавление авто новостей:</h2>
<p><?php
	if(isset($_SESSION['add_auto_news']['res'])) {
		echo $_SESSION['add_auto_news']['res'];
		unset($_SESSION['add_auto_news']['res']);
	} ?></p>
<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="?option=add_auto_news">Добавить авто новость</a></td></tr>
	<tr class="title_news_table">
		<td>Новость</td>
		<td class="del_news">Дата</td>
		<td class="del_news">Удалить?</td>
	</tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="?option=update_auto_news&amp;id_news=<?=$row[0]?>"><?=$row[1]?></a></td>
		<td class="td_date"><?=$row[2]?></td>
		<td class="del_news"><a href="?option=delete_auto_news&amp;id_news=<?=$row[0]?>">Del&nbsp;<img src="img/del.png" width="12" alt="delete"></a></td>
	</tr>
	<?php endforeach; ?>
</table>