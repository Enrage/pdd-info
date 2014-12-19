<section>
	<p><a href="index.html">Главная</a> --> Новости</p>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=view&amp;id_news=<?=$row['id_news']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=view&amp;id_news=<?=$row['id_news']?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
</section>