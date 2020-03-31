<?
include_once "_link.php";

$sql_syndi = "SELECT * FROM syndication WHERE idx=1";
$rs_syndi = mysql_fetch_array(mysql_query($sql_syndi));

// 내 도메인 - 예: www.mydomain.com
$GLOBALS['syndi_tag_domain'] = $rs_syndi['url'];//

// 홈페이지 제목
$GLOBALS['syndi_homepage_title'] = $rs_syndi['url'];

// 타임존
$GLOBALS['syndi_time_zone'] = "+09:00";

// 도메인 연결 날짜 (현재 년도를 넣으면 됨)
$GLOBALS['syndi_tag_year'] = $rs_syndi['createDay'];

// Syndication 출력 url (syndi_echo.php 의 경로)
$GLOBALS['syndi_echo_url'] = "http://".$GLOBALS['syndi_tag_domain']."/syndi/syndi_echo.php";

// 데이타 인코딩
$GLOBALS['syndi_from_encoding'] = "utf-8";

// MySQL 데이터베이스 정보
$GLOBALS['mysql_info'] = array(
	'host'=>'localhost',
	'user'=>'gsi123',
	'password'=>'1234qwer',
	'database'=>'gsi123',
);
?>