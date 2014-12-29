<?php
$count_search_news = $this->m->count_search_news();
$page = $this->m->page();
$count_pages_search = ceil($count_search_news / $this->m->limit);
if(isset($_GET['page'])) {
	$page = (int)$_GET['page'];
	if($page > $count_pages_search) $_SESSION['res'] = "Такой страницы не существует!";
}?>
<section>
	<p><?php if(isset($_SESSION['res'])) {
		print $_SESSION['res'];
		unset($_SESSION['res']);
	}?></p>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<p class="img_article"><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>"><img src="<?=$row['img_src']?>" width="184" alt="News"></a></p>
		<h3><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>"><?=$row['title']?></a></h3>
		<p class="time_article"><?=$row['date']?></p>
		<?=$row['description']?>
		<p class="more"><a href="?option=view&amp;cat=<?=$row['cat']?>&amp;id_news=<?=$row['id_news']?>">Подробнее..</a></p>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($page, $count_search_news); ?></div>
	<?php endif; ?>
</section>