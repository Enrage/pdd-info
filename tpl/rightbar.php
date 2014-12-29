<?php $this->m->search(); ?>
	</div>
		<aside>
			<form action="" method="get">
				<input type="hidden" name="option" value="search">
				<p><input type="text" name="search" placeholder="Что искать"></p>
				<p><input type="submit" value="Найти"></p>
			</form>
			<p class="bilet_pdd">ПДД<br>билеты</p>
			<ul>
				<?php foreach($rightbar as $value): ?>
				<li><a href="?option=bilet&amp;id_bilet=<?=$value['id_bilet']?>"><?=$value['number_bilet']?></a></li>
				<?php endforeach; ?>
			</ul>
			<img src="img/kirpich.png" height="318" width="97" alt="Дорожный знак">
			<p class="rightside_bottom">&nbsp;</p>
		</aside>
	</div>
</div>
<div class="clr"></div>