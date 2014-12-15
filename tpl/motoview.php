<?php
if(isset($_GET['id_moto'])) $id_moto = (int)$_GET['id_moto'];
$res = $this->m->get_text_motonews($id_moto);
?>
<section>
	<p><a href="index.php">Главная</a> --> Новости --> Мото Статья</p>
	<article class="article">
		<h3><?=$res['title']?></h3>
		<p class="time_article"><?=$res['date']?></p>
		<p class="text_article"><?=$res['text']?></p>
	</article>
</section>