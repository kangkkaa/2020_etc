<? include "../inc/link.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

$ck = $_GET['ck'];
$boardID = $_GET['id'];
 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

	$mode = $_GET['mode'];

	$sql_badmin = "SELECT * FROM boardAdmin WHERE board_id='".$boardID."' AND status='Y'";
	$result_badmin = mysql_query($sql_badmin) or die(mysql_error());
	$rs_badmin = mysql_fetch_array($result_badmin);
	
	if (!$rs_badmin) {
		Error('존재하지 않는 게시판입니다.', 'index.php');
	}

	if ($rs_badmin['type_id'] == 1) {
		 if ($mode == "list" || $mode == "") {
			include "board/list.php";
		}
	}else if ($rs_badmin['type_id'] == 2){
		if ($mode == "list" || $mode == "") {
			include "board/list.php";
		}
	}else if ($rs_badmin['type_id'] == 3){
		if ($mode == "list" || $mode == "") {
			include "board/garlley.php";
		}
	}

?>
