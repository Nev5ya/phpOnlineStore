<div class="block">
	<h3 class="header_3">Задание 2</h3>
	<div class="block_flex-wrapper">
		<p>С помощью цикла do…while написать функцию для вывода чисел от 0 до 10.</p><hr>
		<?php
		$i = 0;
		do {
			if ($i == 0) {
				echo "{$i} - это ноль" . '<br>';
			} else if($i & 1) {
				echo "{$i} - не чётное<br>";
			} else {
				echo "{$i} - чётное<br>";
			}
			$i++;
		} while ( $i <= 10);
		?>
	</div>
</div>