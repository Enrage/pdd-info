<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="#">Добавить новую мото статью</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="edit_moto&amp;id_moto=<?=$row['id_moto']?>"><?=$row['title']?></a></td>
		<td align="center">time</td>
		<td align="center">delete</td>
	</tr>
	<?php endforeach; ?>
</table>