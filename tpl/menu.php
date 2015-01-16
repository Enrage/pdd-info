<?php $res = $this->get_content(); ?>
<section>
	<?php foreach($content as $row): ?>
	<article class="contacts">
		<h3><?=$row[1]?></h3>
		<div class="text_menu"><?=$row[2]?></div>
	</article>
	<?php endforeach; ?>
</section>