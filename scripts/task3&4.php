<?php
function sum($arg1, $arg2){
	return $arg1 + $arg2;
}

function sub($arg1, $arg2){
	return $arg1 - $arg2;
}

function mul($arg1, $arg2){
	return $arg1 * $arg2;
}

function div($arg1, $arg2){
	if($arg1 == 0 || $arg2 == 0) {
		return 'Ошибка! На ноль делить нельзя.';
	}
	return round($arg1 / $arg2, 3);
}

function handleData($str){
	return explode(" ", $str);
}

function mathOperation($str){
	$arr = handleData($str);
	switch ($arr[1]) {
		case '+':
			return sum($arr[0], $arr[2]);
		case '-':
			return sub($arr[0], $arr[2]);
		case '*':
			return mul($arr[0], $arr[2]);
		case '/':
			return div($arr[0], $arr[2]);
	}
}

/* Вариант реализации по заданию, выше - собственный

function mathOperation($arg1, $arg2, $operation){
	return $operation($arg1, $arg2);
}
echo mathOperation(4, 7, 'mul');

*/
?>