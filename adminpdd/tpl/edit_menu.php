<h2 class="titles">Меню:</h2>
<p><?php
	if(isset($_SESSION['add_menu']['res'])) {
		echo $_SESSION['add_menu']['res'];
		unset($_SESSION['add_menu']['res']);
	} ?></p>
<table class="news_title">
	<tr><td colspan="2" class="add_new" height="40"><a href="?option=add_menu">Добавить пункт меню</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="?option=update_menu&amp;id_menu=<?=$row['id_menu']?>"><?=$row['name_menu']?></a></td>
		<td class="del_news"><a href="?option=delete_menu&amp;id_menu=<?=$row['id_menu']?>">Del&nbsp;<img src="img/del.png" width="12" alt="delete"></a></td>
	</tr>
	<?php endforeach; ?>
</table>