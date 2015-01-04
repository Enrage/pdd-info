<?php $res = $this->get_pdd_param();?>
<section>
<p class="session"><?php if(isset($_SESSION['res'])) {
		print $_SESSION['res'];
		unset($_SESSION['res']);
	}?></p>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $row): ?>
	<article class="article_desc" id="pdd_desc">
		<h3><?=$row['name_pdd']?></h3>
		<?=$row['text_pdd']?>
	</article>
	<?php endforeach; ?>
	<div class="pagination"><?php print $this->m->page_nav($res[0], $res[1]); ?></div>
	<?php endif; ?>
</section>