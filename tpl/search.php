<?php
$count_search = $this->m->count_search();
$page = $this->m->page();
$count_pages = $this->m->count_pages_search();
// if(isset($_GET['id_news'])):
// $id_news = (int)$_GET['id_news'];
?>
<section>
	<?php foreach ($content as $row): ?>
	<?php if(isset($row['id_news'])): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=view&amp;id_news=<?=$row['id_news']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=view&amp;id_news=<?=$row['id_news']?>">Подробнее..</a></p>
	</article>
	<?php endif; ?>
	<?php endforeach; ?>

<?php
if(isset($_GET['id_moto'])):
$id_moto = (int)$_GET['id_moto'];
?>
<section>
	<?php foreach ($content as $row): ?>
	<?php if(isset($row['id_moto'])): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=motoview&amp;id_moto=<?=$row['id_moto']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=motoview&amp;id_moto=<?=$row['id_moto']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=motoview&amp;id_moto=<?=$row['id_moto']?>">Подробнее..</a></p>
	</article>
	<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
	<div class="pagination"><?php print $this->m->page_nav($page, $count_search); ?></div>
</section>