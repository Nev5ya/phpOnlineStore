<div class="block">
	<h3 class="header_3">Задание 1</h3>
	<div class="block_flex-wrapper">
		<p>С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.</p><hr>
		<? $i = 0; while($i <= 100): ?>
			<? if($i % 3 == 0)
				echo $i;
				$i++;
			?>
		<? endwhile; ?>
	</div>
</div>