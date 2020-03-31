<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
include "../inc/class.image.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$mode=$_POST['mode'];
$siteUrl = $_POST['siteUrl'];
$exceptTable = htmlspecialchars(addslashes(trim($_POST['exceptTable']))); 
$status = $_POST['status'];
if($state==""){
	$state=="N";
}
$createDay =  substr(date('Ymd', strtotime("NOW")),0,4);

if($mode=="insert"){
	$sql = "INSERT syndication SET idx='1', status='".$status."', url='".$siteUrl."', exceptTable='".$exceptTable."', createDay='".$createDay."'";
	//테이블있는지확인하고 생성하기 (IF NOT EXISTS)
	$sqltable = "CREATE TABLE IF NOT EXISTS `syndi_delete_content_log` (`content_id` bigint(11) NOT NULL, `bbs_id` varchar(50) NOT NULL, `title` text NOT NULL, `link_alternative` varchar(250) NOT NULL, `delete_date` datetime NOT NULL, PRIMARY KEY  (`content_id`,`bbs_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	mysql_query($sqltable) or die(mysql_error());
}else{
	$sql = "UPDATE syndication SET status='".$status."', url='".$siteUrl."', exceptTable='".$exceptTable."', createDay='".$createDay."' WHERE idx=1";
}
mysql_query($sql) or die(mysql_error());
mysql_close($connect);

Error('설정 저장이 완료되었습니다.', 'ping.php');

?>