<?php
if(isset($_GET['id_news'])) $id_news = (int)$_GET['id_news'];
$res = $this->m->get_text_moto_news($id_news);
?>
<section>
	<article class="article">
		<h3><?=$res['title']?></h3>
		<p class="time_article"><?=$res['date']?></p>
		<?=$res['text']?>
	</article>
</section>