<?
function stringCut($str) {
	$result = ""; 
	if (strlen($str) > 1000) { // strlen함수는 문자열길이 구하는 함수입니다. 
		$result = substr($str, 0, 200); // substr함수는 문자열 자르기 함수입니다. 
		$result = $result . "..."; // 자른 문자열 끝에 "..." 붙입니다. 
	} else { 
		$result = $str; // 문자열길이가  20 이하 일경우 " ..." 붙이지 않고 그대로 
	} 
	return $result; 
} 
?>