<?php
if(isset($_GET['id_bilet'])) $id_bilet = (int)$_GET['id_bilet'];
$res = $this->get_content();
?>
<section class="bilets">
<?php if(isset($res)): ?>
	<?=$this->nav()?>
	<article class="bilet">
		<h3 class="nbilet">Билет №<span id="id_bilet"><?=$id_bilet?></span></h3>
			<?php foreach($res as $id_question => $item): ?>
			<div class="question" data-id="<?=$id_question?>" id="question-<?=$id_question?>">
				<?php foreach($item as $id_answer => $answer): ?>
					<?php if(!$id_answer): ?>
					<p class="q"><?=$answer?></p>
					<?php else: ?>
					<p class="a">
						<input type="radio" name="question-<?=$id_question?>" id="answer-<?=$id_answer?>" value="<?=$id_answer?>">
						<label for="answer-<?=$id_answer?>"><?=$answer?></label>
					</p>
					<?php endif; ?>
				<?php endforeach; // $item ?>
			</div>
			<?php endforeach; // $res ?>
		<div class="next_button">
			<button class="next">Следующий вопрос</button>
		</div>
	</article>
	<div class="buttons">
		<button class="btn" id="btn">Закончить тест</button>
	</div>
	<div class="content"></div>
<?php else: ?>
	<p>Нет такого билета!</p>
<?php endif; ?>
</section>