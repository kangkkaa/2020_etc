<?php
session_start();

//if (is_array($HTTP_GET_VARS)) extract($HTTP_GET_VARS);
//if (is_array($HTTP_POST_VARS)) extract($HTTP_POST_VARS);
//if (is_array($HTTP_SERVER_VARS)) extract($HTTP_SERVER_VARS);
//if (is_array($HTTP_COOKIE_VARS)) extract($HTTP_COOKIE_VARS);
//if (is_array($HTTP_POST_FILES)) extract($HTTP_POST_FILES);
//if (is_array($HTTP_ENV_VARS)) extract($HTTP_ENV_VARS);

// DB Connection 



function db_connect() {

	global $default_dbname;
	global $MYSQL_ERRNO, $MYSQL_ERROR;


	$connect = mysql_connect("localhost","hwauin","thwls1521");
	if (!$connect) {
		$MYSQL_ERRNO = 0;
		$MYSQL_ERROR = "$dbhost에 연결할 수 없습니다.";
		return 0;
	} else if (!mysql_select_db("hwauin")) {
		$MYSQL_ERRNO = mysql_errno();
		$MYSQL_ERROR = mysql_error();
		return 0;
	} else {
		return $connect;
	}
}
// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
	Error("d",'index.php');
    $cookie = md5($cookie_name);
    if (array_key_exists($cookie, $_COOKIE))
        return base64_decode($_COOKIE[md5($cookie_name)]);
    else
        return "";

	
}


// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire)
{
	define('SERVER_TIME', time());
	define('COOKIE_DOMAIN', '');
    setcookie(md5($cookie_name), base64_encode($value), SERVER_TIME + $expire, '/', COOKIE_DOMAIN);
}


// Error print function
function Error($message, $url) {
	if ($url) {
		$message = str_replace("<br>","\\n",$message);
		$message = str_replace("\"","\\\"",$message);
		echo "<script>alert('".$message."'); location.href='".$url."';</script>";
		exit;
	} else {
		echo "<script>alert('".$message."');</script>";
	}
	exit;
}

function ip_cut($ipadd) {
	$ipsql = "select idx from bpm_access_ip where cut_ip='".$ipadd."'";
	$iprs = mysql_fetch_array(mysql_query($ipsql));

	if ($iprs['idx']){
		Error('사이트 접근 권한이 없습니다.','');
		exit;
	}
}

function Checkit($CheckValue) {
	$CheckValue = str_replace("&" , "&amp;", $CheckValue);
	$CheckValue = str_replace("'", "&quot;", $CheckValue);
	$CheckValue = str_replace("\"", "&quot;", $CheckValue);
	$CheckValue = str_replace("<P>", "", $CheckValue);
	$CheckValue = str_replace("</P>", "<br>", $CheckValue);
	return $CheckValue;
}

function Checkot($CheckValue) {
	$CheckValue = str_replace("&quot;", "'", $CheckValue);
	$CheckValue = str_replace("&amp;", "&", $CheckValue);
	$CheckValue = str_replace(chr(13), "<br>", $CheckValue);
	$CheckValue = str_replace("<br><br>", "<br>", $CheckValue);
	return $CheckValue;
}

function new_icon($date_value,$num) {
	$check_time=(time()-$date_value)/60/60;
	
	$num = (int)$num;
	
	if($check_time<=(24*$num)) $new_icon=" <img src=\"../images/icon_new.png\" align=absmiddle border=0>";
	else $new_icon="";
	
	return $new_icon;
}

function adm_new_icon($date_value,$num) {
	$check_time=(time()-$date_value)/60/60;
	
	$num = (int)$num;
	
	if($check_time<=(24*$num)) $new_icon=" <img src=\"../images/icon_new.png\" align=absmiddle border=0>";
	else $new_icon="";
	
	return $new_icon;
}
?>