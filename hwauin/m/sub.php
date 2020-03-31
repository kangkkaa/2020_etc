<?
include_once "_link.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$ck = $_GET['ck'];
$boardID = $_GET['id'];
 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

if($ck == "P"){
	if($boardID=="locationOrionnet")
	{
		include "location.php";
	}else{

		$sql = "SELECT * FROM pageTable WHERE idx=".$boardID;
		$result = mysql_query($sql) or die(mysql_error());
		$rs_page = mysql_fetch_array($result);
		include "page.php";
	}
}else if($ck == "B"){
	$mode = $_GET['mode'];

	$sql_badmin = "SELECT * FROM boardAdmin WHERE board_id='".$boardID."'";
	$result_badmin = mysql_query($sql_badmin) or die(mysql_error());
	$rs_badmin = mysql_fetch_array($result_badmin);
	
	if (!$rs_badmin) {
		Error('존재하지 않는 게시판입니다.', 'index.php');
	}
	if ($rs_badmin['status']!='Y'){
		Error('현재 사용하실 수 없습니다.', 'index.php');
	}
	if($boardID=="contactusOrionnet"){
?>
		<script>
		location.href = "contactus.php";
		</script>
<?
	}

	if ($rs_badmin['type_id'] == 1) {
		if ($mode == "view") {
			include "board/view.php";
		} else if ($mode == "insert") {
			include "board/write.php";
		} else if ($mode == "list" || $mode == "") {
			include "board/list.php";
		}
	}else if ($rs_badmin['type_id'] == 2){
		if ($mode == "view") {
			include "board/view.php";
		} else if ($mode == "insert") {
			include "board/write.php";
		} else if ($mode == "list" || $mode == "") {
			include "board/list.php";
		}
	}else if ($rs_badmin['type_id'] == 3){
		if ($mode == "view") {
			include "board/view.php";
		} else if ($mode == "insert") {
			include "board/write.php";
		} else if ($mode == "list" || $mode == "") {
			include "board/gallery.php";
		}
	}
}
?>
