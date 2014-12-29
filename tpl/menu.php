<?php $res = menu::get_content(); ?>
<section>
	<article class="article">
		<h3><?=$res['name_menu']?></h3>
		<div class="text_menu"><?=$res['text_menu']?></div>
	</article>
</section>