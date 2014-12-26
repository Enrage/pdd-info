<?php
$count_pdd = $this->m->count_pdd();
$page = $this->m->page();
$count_pages = $this->m->count_pages_pdd();
if($page > $count_pages) {
	$page = $count_pages;
}
?>
<section>
	<p><a href="index.php">Главная</a> --> ПДД</p>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<h3><?=$row['name_pdd']?></h3>
		<?=$row['text_pdd']?>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($page, $count_pdd); ?></div>
</section>