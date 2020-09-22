<?php
	include('date.php');
	$content = file_get_contents('template.html');

	$title = 'Информация обо мне';

	$content = str_replace("{{ h1 }}", $title, $content);
	
	$content = str_replace("{{ year }}", $template, $content);
	echo $content;

	/* task 5
	 	swap two vars
		$a=$a+$b-($b=$a)
	*/

	/* task 3
		$a = 5;
		$b = '05';

		var_dump($a == $b); // true потому что производится не строгое сравнение с приведением типа

		var_dump((int)'00012345'); // Почему 12345? При явном приведении строки в целочисленное число - нули отбрасываются

		var_dump((float)123.0 === (int)123.0); // false потому что сравнение строгое со сравнением типов - они разные

		var_dump((int)0 === (int)'hello, world'); // true потому что приведение строки к численному типу дает 0
	*/
?>