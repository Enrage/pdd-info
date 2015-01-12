<div id="main">
	<div id="container">
		<nav class="top_menu">
			<ul>
				<li><a href="?option=main">Главная</a></li>
				<li><a href="?option=news">Новости</a></li>
				<li><a href="?option=moto">Мото</a></li>
				<li><a href="?option=pdd">ПДД</a></li>
				<li><a href="?option=bilets">Билеты</a></li>
				<?php foreach($top_menu as $value): ?>
				<li><a href="?option=menu&amp;id_menu=<?=$value['id_menu']?>"><?=$value['name_menu']?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>