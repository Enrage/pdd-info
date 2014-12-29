<?php $res = view::get_content(); ?>
<section>
	<p><a href="index.php">Главная</a> --> Новости --> Статья</p>
	<article class="article">
		<h3><?=$res['title']?></h3>
		<p class="time_article"><?=$res['date']?></p>
		<?=$res['text']?>
	</article>
</section>