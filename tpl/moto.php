<?php
$count_moto_news = $this->m->count_moto_news();
$page = $this->m->page();
?>
<section>
	<p><a href="index.html">Главная</a> --> Мото новости</p>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=moto_view&amp;id_news=<?=$row['id_news']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=moto_view&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=moto_view&amp;id_news=<?=$row['id_news']?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($page, $count_moto_news); ?></div>
</section>