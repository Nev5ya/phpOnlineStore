<?php
function getDictionary(){
			return $arr = [
				'а' => 'а',
				'б' => 'b',
				'в' => 'v',
				'г' => 'g',
				'д' => 'd',
				'е' => 'e',
				'ё' => 'e',
				'ж' => 'j',
				'з' => 'z',
				'и' => 'i',
				'к' => 'k',
				'л' => 'l',
				'м' => 'm',
				'н' => 'n',
				'о' => 'o',
				'п' => 'p',
				'р' => 'r',
				'с' => 's',
				'т' => 't',
				'у' => 'u',
				'ф' => 'f',
				'х' => 'h',
				'ц' => 'c',
				'ч' => '4',
				'ш' => 'sh',
				'щ' => 'shc',
				'ъ' => '',
				'ы' => 'y',
				'ь' => '',
				'э' => 'e',
				'ю' => 'yu',
				'я' => '9',
				' ' => '_'
			];
		}

		function translit($str){
			$dictionary = getDictionary();
			$res = '';

			for ($i = 0; $i < mb_strLen($str); $i++) {
				$char = mb_substr($str, $i, 1);
				if (empty($dictionary[$char])) {
					$char = mb_strtolower($char);
					$res .= mb_strtoupper($dictionary[$char]);
				} else {
					$res .= $dictionary[$char];
				}
			}
			return $res;
		}
?>
<div class="block">
	<h3 class="header_3">Задание 4, 5 и 9</h3>
	<div class="block_flex-wrapper">
		<p> Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания.</p><hr>
		<?= translit('Транслит стРоки'); ?>
	</div>
</div>