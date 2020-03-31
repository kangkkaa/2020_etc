<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$mode = $_POST['mode'];
$po_subject = $_POST['po_subject'];
$po_time = $_POST['po_time'];
$po_starttime = $_POST['po_starttime'];
$po_endtime = $_POST['po_endtime'];
$po_left = $_POST['po_left'];
$po_top = $_POST['po_top'];
$po_width = $_POST['po_width'];
$po_height = $_POST['po_height'];
$po_link = $_POST['po_link'];
$po_target = $_POST['po_target'];
$po_contents = $_POST['content'];


if($mode == "insert"){

	$sql_pid = "SELECT MAX(idx) idx FROM popupAdmin";
	$rs_pid = mysql_fetch_array(mysql_query($sql_pid));

	if (!$rs_pid['idx']) {
		$idx = 1;
	} else {
		$idx = $rs_pid['idx']+1;
	}
	unset($rs_pid);

	$sql = "INSERT popupAdmin SET idx = '".$idx."', po_subject='".$po_subject."', po_starttime='".$po_starttime."', po_endtime='".$po_endtime."', po_left='".$po_left."', po_top='".$po_top."', po_width='".$po_width."', po_height='".$po_height."', po_link='".$po_link."', po_target='".$po_target."', po_contents='".$po_contents."', po_time='".$po_time."'";
	mysql_query($sql) or die(mysql_error());

	Error("정상적으로 등록하셨습니다.", 'popupAdmin.php');
}else if($mode == "modify"){
	$idx = $_POST['pidx'];
	$sql = "UPDATE popupAdmin SET po_subject='".$po_subject."', po_starttime='".$po_starttime."', po_endtime='".$po_endtime."', po_left='".$po_left."', po_top='".$po_top."', po_width='".$po_width."', po_height='".$po_height."', po_link='".$po_link."', po_target='".$po_target."', po_contents='".$po_contents."', po_time='".$po_time."' WHERE idx='".$idx."'";
	mysql_query($sql) or die(mysql_error());

	Error("정상적으로 수정하셨습니다.", 'popupAdmin.php');
}else if($mode == "delete"){
	$idx = $_POST['pidx'];

	$sql = "DELETE FROM popupAdmin WHERE idx='".$idx."'";
	mysql_query($sql) or die(mysql_error());

	Error("정상적으로 삭제하셨습니다.", 'popupAdmin.php');
}
?>