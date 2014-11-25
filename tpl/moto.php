<section>
	<p><a href="index.html">Главная</a> --> Мото новости</p>
	<?php foreach ($content as $row): ?>
	<article class="article">
		<p class="img_article"><a href="?option=view&amp;id_moto=<?=$row['id_moto']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;id_moto=<?=$row['id_moto']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<p class="text_article"><?=$row['description']?></p>
		<p class="more"><a href="?option=view&amp;id_moto=<?=$row['id_moto']?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
</section>