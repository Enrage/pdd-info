<table class="news_title">
	<tr><td colspan="2" class="add_new" height="40"><a href="#">Добавить новый пункт меню</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="edit_menu&amp;id_menu=<?=$row['id_menu']?>"><?=$row['name_menu']?></a></td>
		<td align="center">delete</td>
	</tr>
	<?php endforeach; ?>
</table>