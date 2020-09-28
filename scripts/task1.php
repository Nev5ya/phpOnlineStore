<?php
$a = rand(-50, 50);
$b = rand(-50, 50);

if ($a && $b > 0) {
	$sub = $a - $b;
} elseif ($a && $b < 0) {
	$mul = $a * $b;
} else {
	$sum = $a + $b;
}
?>