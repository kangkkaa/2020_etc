<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include_once "_link.php";

$b_idx = $_POST['b_idx'];
$ck = $_POST['ck'];
$boardID = $_POST['id'];
$npage = $_POST['npage'];
$search_text = $_POST['search_text'];
$mode = $_POST['mode'];

$sql = "SELECT MAX(c_id) c_max FROM board_comment";
$rs = mysql_fetch_array(mysql_query($sql));

if (!$rs['c_max']) {
	$c_id = 1;
} else {
	$c_id = $rs['c_max']+1;
}
unset($rs);

$url = "../sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=".$ck."&mode=".$mode."&search_text=".$search_text;
$cwriter = addslashes(htmlspecialchars($_POST['b_commentWriter']));
$b_comment = addslashes(htmlspecialchars($_POST['b_comment']));
$b_commentPW = addslashes(htmlspecialchars($_POST['b_commentPW']));

$memberID ="guest";

$sql = "INSERT board_comment SET c_id='".$c_id."', b_id='".$b_idx."', board_id='".$boardID."', member_id='".$memberID."', c_writerName='".$cwriter."', c_password='".$b_commentPW."', c_contents='".$b_comment."', c_ip='".$_SERVER["REMOTE_ADDR"]."', c_regDate=NOW()";
mysql_query($sql) or die(mysql_error());
$sqlB = "UPDATE boardTable SET b_commentCnt = b_commentCnt+1 WHERE board_id='".$boardID."'AND b_id='".$b_idx."'";
mysql_query($sqlB) or die(mysql_error());
Error("덧글이 정상적으로 등록되었습니다.", $url)
?>