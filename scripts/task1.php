<?php
$a = rand(-50, 50);
$b = rand(-50, 50);

if ($a >= 0 && $b >= 0) {
	$sub = $a - $b;
} elseif ($a < 0 || $b < 0) {
	$mul = $a * $b;
} else {
	$sum = $a + $b;
}
?>