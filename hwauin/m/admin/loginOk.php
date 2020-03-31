<?
include "../inc/lib.php";

if ($_POST['adminID'] == "" || $_POST['adminPW'] == "") {
	echo "noinput";
	exit();
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$sql = "SELECT * FROM m_member WHERE mem_id='".trim($_POST['adminID'])."' AND mem_level<3 AND mem_status='Y'";
$result = mysql_query($sql) or die(mysql_error());
$rs = mysql_fetch_array($result);

if (!$rs['idx']) {

	unset($rs);
	mysql_close($connect);
	echo "nomember";
	exit();

} else {

	if (hash('sha512', trim($_POST['adminPW'])) == $rs['mem_pw']) {

		$_SESSION['mobile']['admIdx']	 = $rs['idx'];
		$_SESSION['mobile']['admId']	 = $rs['mem_id'];
		$_SESSION['mobile']['admName']	 = $rs['mem_name'];
		$_SESSION['mobile']['admEmail']  = $rs['mem_email'];
		$_SESSION['mobile']['admTel']    = $rs['mem_tel'];
		$_SESSION['mobile']['admLevel']  = $rs['mem_level'];

		unset($rs);
		mysql_close($connect);

		echo "success";
		exit();

	} else {

		unset($rs);
		mysql_close($connect);
		echo "nopwd";
		exit();

	}
}
?>