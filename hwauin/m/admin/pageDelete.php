<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');


$p_id = $_POST['pidx'];
$url = "pageConfig.php";
$sqlP = "DELETE FROM pageTable WHERE idx ='".$p_id."'"; 
mysql_query($sqlP) or die(mysql_error());

$sqlC = "DELETE FROM contentConfig WHERE contentId ='".$p_id."' AND contentKind='P'";
mysql_query($sqlC) or die(mysql_error());


Error("컨텐츠를 정상으로 삭제하셨습니다.", $url);
?>