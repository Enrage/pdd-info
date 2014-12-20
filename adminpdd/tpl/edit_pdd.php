<h2 class="titles">Добавление правил дорожного движения:</h2>
<p><?php
	if(isset($_SESSION['add_pdd']['res'])) {
		echo $_SESSION['add_pdd']['res'];
		unset($_SESSION['add_pdd']['res']);
	} ?></p>
<table class="news_title">
	<tr><td colspan="2" class="add_new" height="40"><a href="?option=add_pdd">Добавить новое правило</a></td></tr>
	<?php foreach ($content as $row): ?>
	<tr>
		<td><a href="?option=update_pdd&amp;id_pdd=<?=$row['id_pdd']?>"><?=$row['name_pdd']?></a></td>
		<td class="del_news"><a href="?option=delete_pdd&amp;id_pdd=<?=$row['id_pdd']?>">Del&nbsp;<img src="img/del.png" width="12" alt="delete"></a></td>
	</tr>
	<?php endforeach; ?>
</table>
