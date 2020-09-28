<?php
function power($val, $pow){
	if($pow !== 0) {
    	return $val * pow($val, $pow - 1);
	} 
	return 1;
}


$val = 2;
$pow = 8;
$res = power($val, $pow);
?>