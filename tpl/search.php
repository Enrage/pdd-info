<?php $res = $this->get_search_param();?>
<section>
	<p class="session"><?php if(isset($_SESSION['res'])) {
		print $_SESSION['res'];
		unset($_SESSION['res']);
	}?></p>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=view&amp;cat=<?=$row[1]?>&amp;id_news=<?=$row[0]?>"><img src="<?=$row[8]?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;cat=<?=$row[1]?>&amp;id_news=<?=$row[0]?>"><?=$row[2]?></a></h3>
		<p class="time_article"><?=$row[7]?></p>
		<?=$row[3]?>
		<p class="more"><a href="?option=view&amp;cat=<?=$row[1]?>&amp;id_news=<?=$row[0]?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($res[0], $res[1]); ?></div>
	<?php endif; ?>
</section>