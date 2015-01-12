<section class="bilets">
	<h4>Экзаменационные билеты</h4>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row['id'] < 11): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row['id']?>"><?=$row['bilet']?></a></p><br>
		<?php endif; ?>
	<?php endforeach;?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row['id'] > 10 AND $row['id'] < 21): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row['id']?>"><?=$row['bilet']?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row['id'] > 20 AND $row['id'] < 31): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row['id']?>"><?=$row['bilet']?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row['id'] > 30): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row['id']?>"><?=$row['bilet']?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
</section>