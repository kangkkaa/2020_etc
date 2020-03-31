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
$content = htmlspecialchars(addslashes(trim($_POST['ga_code']))); 
$state= $_POST['analyticsYN'];
if($state==""){
	$state=="N";
}

if($mode=="insert"){
	$sql = "INSERT googleAnalytics SET no='1', content='".$content."', state='".$state."'";
}else{
	$sql = "UPDATE googleAnalytics SET content='".$content."', state='".$state."' where no=".$index;
}
mysql_query($sql) or die(mysql_error());
mysql_close($connect);

Error('설정 저장이 완료되었습니다.', 'logConfig.php');

?>