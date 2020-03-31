<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include_once "_link.php";

$c_name = addslashes(htmlspecialchars($_POST['c_name']));
$c_mobile = addslashes(htmlspecialchars($_POST['c_mobile']));
$c_mail = addslashes(htmlspecialchars($_POST['c_mail']));
$c_subject = addslashes(htmlspecialchars($_POST['c_subject']));
$contactMessage = addslashes(htmlspecialchars($_POST['contactMessage']));
$boardID ="contactusOrionnet"; 

$sql_bid = "SELECT MAX(b_id) b_id FROM boardTable";
$rs_bid = mysql_fetch_array(mysql_query($sql_bid));

if($rs_bid['b_id']==0){
	$b_idx = 1;
}else{
	$b_idx = $rs_bid['b_id'] + 1;
}
unset($rs_bid);

$url = "contactus.php";
$sql = "INSERT boardTable SET b_id='".$b_idx."', board_id='".$boardID."', b_writerName='".$c_name."', b_subject='".$c_subject."', b_contents='".$contactMessage."', b_hit='0', b_parent='".$b_idx."', b_noticeYN='N', b_ip='".$_SERVER['REMOTE_ADDR']."', b_writeday=NOW(), b_commentCnt='0', b_secretYN='N', b_replyYN='N', b_replyCnt='0', c_mail ='".$c_mail."', c_mobile='".$c_mobile."'";

mysql_query($sql) or die(mysql_error());

Error("문의/상담이 정상적으로 접수되었습니다.", $url);
?>