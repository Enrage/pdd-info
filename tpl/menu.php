<?php
if(isset($_GET['id_menu'])) $id_menu = (int)$_GET['id_menu'];
$res = $this->m->get_text_menu($id_menu);
?>
<section>
	<article class="article">
		<h3><?=$res['name_menu']?></h3>
		<p class="text_article"><?=$res['text_menu']?></p>
	</article>
</section>