<?php
if(isset($_GET['id_menu'])) $id_menu = (int)$_GET['id_menu'];
$res = $this->m->get_text_menu($id_menu);
?>
<section>
	<article class="article">
		<h3><?=$res['name_menu']?></h3>
		<div class="text_menu"><?=$res['text_menu']?></div>
	</article>
</section>