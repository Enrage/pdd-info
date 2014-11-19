<?php $rows = $this->m->get_top_menu(); ?>
<div id="main">
	<div id="container">
		<nav class="top_menu">
			<ul>
				<li><a href="?option=main">Главная</a></li>
				<li><a href="?option=news">Новости</a></li>
				<li><a href="?option=moto">Мото</a></li>
				<li><a href="?option=pdd">ПДД</a></li>
				<?php foreach($rows as $value): ?>
				<li><a href="?option=menu&amp;id=<?=$value['id_menu']?>"><?=$value['name_menu']?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>