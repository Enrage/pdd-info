<footer>
	<p class="car1"><img src="img/sports-car_04.png" alt="Автомобиль"></p>
	<p class="konus2"><img src="img/konus.png" alt="Конус"></p>
	<p class="car2"><img src="img/sports-car_06.png" alt="Автомобиль2"></p>
	<nav class="bottom_menu">
		<ul>
			<li><a href="?option=main">Главная</a></li>
			<li><a href="?option=news">Новости</a></li>
			<li><a href="?option=moto">Мото</a></li>
			<li><a href="?option=pdd">ПДД</a></li>
			<?php foreach($footer as $row): ?>
			<li><a href="?option=menu&amp;id_menu=<?=$row['id_menu']?>"><?=$row['name_menu']?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<p class="bike_cross"><img src="img/bike_cross.png" alt="Мотоцикл"></p>
	<div class="live"><a href="http://www.liveinternet.ru/" target="_blank"><img src="img/liveinternet.jpg" height="31" width="88" alt="Liveinternet"></a></div>
	<p class="copyright">Copyright &copy; pdd-info.ru</p>
</footer>
</body>
</html>