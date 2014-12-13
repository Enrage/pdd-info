<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="#">Добавить новую статью</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="edit_news&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></td>
		<td align="center">time</td>
		<td align="center">delete</td>
	</tr>
	<?php endforeach; ?>
</table>