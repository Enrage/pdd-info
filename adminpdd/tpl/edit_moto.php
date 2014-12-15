<h2 class="titles">Добавление мото новостей:</h2>
<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="?option=add_moto">Добавить мото новость</a></td></tr>
	<tr class="title_news_table">
		<td>Мото новость</td>
		<td class="del_news">Дата</td>
		<td class="del_news">Удалить?</td>
	</tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="update_moto&amp;id_moto=<?=$row['id_moto']?>"><?=$row['title']?></a></td>
		<td class="td_date"><?=$row['date']?></td>
		<td class="del_news"><a href="?option=delete_moto&amp;id_moto=<?=$row['id_moto']?>">Del&nbsp;<img src="img/del.png" width="12" alt="delete"></a></td>
	</tr>
	<?php endforeach; ?>
</table>