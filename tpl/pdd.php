<?php
$count_pdd = $this->m->count_pdd();
$page = $this->m->page();
$count_pages_pdd = ceil($count_pdd / $this->m->limit);
if(isset($_GET['page'])) {
	$page = (int)$_GET['page'];
	if($page > $count_pages_pdd) $_SESSION['res'] = "Такой страницы не существует!";
}?>
<section>
<p><?php if(isset($_SESSION['res'])) {
		print $_SESSION['res'];
		unset($_SESSION['res']);
	}?></p>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $row): ?>
	<article class="article_desc">
		<h3><?=$row['name_pdd']?></h3>
		<?=$row['text_pdd']?>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($page, $count_pdd); ?></div>
	<?php endif; ?>
</section>