<table class="news_title">
	<tr><td colspan="3" class="add_new" height="40"><a href="#">Добавить новое правило</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="edit_pdd&amp;id_pdd=<?=$row['id_pdd']?>"><?=$row['name_pdd']?></a></td>
		<td align="center">time</td>
		<td align="center">delete</td>
	</tr>
	<?php endforeach; ?>
</table>