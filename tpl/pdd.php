<section>
	<p><a href="index.php">Главная</a> --> ПДД</p>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<h3><?=$row['name_pdd']?></h3>
		<?=$row['text_pdd']?>
		<!-- <p class="more"><a href="?option=view&amp;id_pdd=<?=$row['id_pdd']?>">Подробнее..</a></p> -->
	</article>
	<?php endforeach; ?>
</section>