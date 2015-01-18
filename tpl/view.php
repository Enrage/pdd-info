<section>
	<?php if(!empty($content)): ?>
	<?php foreach ($content as $res): ?>
	<article class="article">
		<h3><?=$res[1]?></h3>
		<p class="time_article"><?=$res[5]?></p>
		<?=$res[2]?>
	</article>
	<?php endforeach; ?>
	<?php endif; ?>
</section>