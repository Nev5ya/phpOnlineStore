<?php

function parseOperations($str) {
	
	if(strlen($str) < 3) return $str;

	$operations = [
		'+' => 'sum',
		'-' => 'sub',
		'*' => 'mul',
		'/' => 'div'
	];

	$arg1 = preg_split('/[\+\-\*\/]+/', $str)[0];
	$arg2 = preg_split('/[\+\-\*\/]+/', $str)[1];
	$operation = preg_split('/[^\+\-\*\/]+/', $str)[1];

	return mathOperation($arg1, $arg2, $operations[$operation]);
}

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
	if($arg2 == 0) {
		return 'Ошибка! На ноль делить нельзя.';
	}
	return $arg1 / $arg2;
}

function mathOperation($arg1, $arg2, $operation){
	if(function_exists($operation)){
		return $operation($arg1, $arg2);
	}
}
