<?
include_once "_link.php";

$sql_syndi = "SELECT * FROM syndication WHERE idx=1";
$rs_syndi = mysql_fetch_array(mysql_query($sql_syndi));

// �� ������ - ��: www.mydomain.com
$GLOBALS['syndi_tag_domain'] = $rs_syndi['url'];//

// Ȩ������ ����
$GLOBALS['syndi_homepage_title'] = $rs_syndi['url'];

// Ÿ����
$GLOBALS['syndi_time_zone'] = "+09:00";

// ������ ���� ��¥ (���� �⵵�� ������ ��)
$GLOBALS['syndi_tag_year'] = $rs_syndi['createDay'];

// Syndication ��� url (syndi_echo.php �� ���)
$GLOBALS['syndi_echo_url'] = "http://".$GLOBALS['syndi_tag_domain']."/syndi/syndi_echo.php";

// ����Ÿ ���ڵ�
$GLOBALS['syndi_from_encoding'] = "utf-8";

// MySQL �����ͺ��̽� ����
$GLOBALS['mysql_info'] = array(
	'host'=>'localhost',
	'user'=>'gsi123',
	'password'=>'1234qwer',
	'database'=>'gsi123',
);
?>