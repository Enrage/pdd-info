<?php $res = news::get_auto_param();?>
<section>
<p><?php if(isset($_SESSION['res'])) {
		print $_SESSION['res'];
		unset($_SESSION['res']);
	}?></p>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $row):?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>">Подробнее..</a></p>
	</article>
	<?php endforeach;?>
	<div class="pagination"><?php print $this->m->page_nav($res[0], $res[1]); ?></div>
	<?php endif;?>
</section>