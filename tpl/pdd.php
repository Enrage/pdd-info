<section>
	<p><a href="index.php">Главная</a> --> ПДД</p>
	<?php foreach ($content as $row): ?>
	<article class="article">
		<h3><?=$row['name_pdd']?></h3>
		<p class="text_article"><?=$row['text_pdd']?></p>
		<p class="more"><a href="?option=view&amp;id_pdd=<?=$row['id_pdd']?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
</section>