<?
include "../inc/lib.php";
if ($_POST['mem_id'] == "") {
	echo "noinput";
	exit();
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$accountId = trim($_POST['mem_id']);

$sql = "SELECT * FROM m_member WHERE mem_id='".$accountId."'";
$result = mysql_query($sql) or die(mysql_error());
$rs = mysql_fetch_array($result);

if ($rs['idx']) {
	echo "memnotok";
	mysql_close($connect);
	exit();
} else {
	echo "memok";
	mysql_close($connect);
	exit();
}
?>