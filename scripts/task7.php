<?php
function getHours(){
	return date('H');
}

function getMinutes(){
	return date('i');
}

function handleCases($str, $for_1, $for_2, $for_5){
	$str = abs($str) % 100;
	$str_x = $str % 10;

	if ($str > 10 && $str < 20){ //11 - 19
		return $for_5;
	}
	if ($str_x > 1 && $str_x < 5){ //2,3,4
		return $for_2;
	}
	if ($str_x == 1){ //1
		return $for_1;
	}
	return $for_5;	
}

$h = handleCases(getHours(), 'час', 'часа', 'часов');
$m = handleCases(getMinutes(), 'минута', 'минуты', 'минут');
?>