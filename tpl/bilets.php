<section class="bilets">
	<h4>Экзаменационные билеты</h4>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row[0] < 11): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row[0]?>"><?=$row[1]?></a></p><br>
		<?php endif; ?>
	<?php endforeach;?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row[0] > 10 AND $row[0] < 21): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row[0]?>"><?=$row[1]?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row[0] > 20 AND $row[0] < 31): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row[0]?>"><?=$row[1]?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
	<div class="sort_bilet">
	<?php foreach ($content as $row):?>
		<?php if($row[0] > 30): ?>
		<p><a href="?option=bilet&amp;id_bilet=<?=$row[0]?>"><?=$row[1]?></a></p><br>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
</section>