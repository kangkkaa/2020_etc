<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$mem_idx = $_POST['midx'];
$processMode = $_POST['processMode'];
$mode = $_POST['mode'];
$member_id = trim($_POST['mem_id']);
$member_pw = hash('sha512', trim($_POST['mem_pw']));
$member_name = trim($_POST['mem_name']);
$member_email = trim($_POST['mem_email']);
$member_tel = trim($_POST['mem_tel']);

$moveUrl_m = "member-view.php?midx=".$mem_idx."&mode=".$mode."&npage=".$_POST['npage']."&search_text=".$_POST['search_text'];
$moveUrl_i = "member.php?mode=".$mode;

if ($processMode == "modify") {

	$status = $_POST['mem_status'];
	$exit = "";
	if ($status == "Y") {
		if ($_POST['mem_pw'] == "") {
			$sqlm = "UPDATE m_member SET mem_email='".$member_email."', mem_name='".$member_name."', mem_tel='".$member_tel."', mem_exitdate='', mem_status='".$status."' WHERE idx=".$mem_idx;
		} else {
			$sqlm = "UPDATE m_member SET mem_pw ='".$member_pw."', mem_email='".$member_email."', mem_name='".$member_name."', mem_tel='".$member_tel."', mem_exitdate='', mem_status='".$status."', WHERE idx=".$mem_idx;
		}
	} else if ($status == "N") {`
		if ($_POST['mem_pw'] == "") {
			$sqlm = "UPDATE m_member SET mem_email='".$member_email."', mem_name='".$member_name."', mem_tel='".$member_tel."', mem_status='".$status."', mem_exitdate =NOW() WHERE idx=".$mem_idx;
		} else {
			$sqlm = "UPDATE m_member SET mem_pw ='".$member_pw."', mem_email='".$member_email."', mem_name='".$member_name."', mem_tel='".$member_tel."', mem_status='".$status."', mem_exitdate=NOW() WHERE idx=".$mem_idx;
		}
	}
	
	mysql_query($sqlm) or die(mysql_error());
	mysql_close($connect);
	Error('회원 정보가 수정되었습니다.', $moveUrl_m);

} else if ($processMode == "insert") {

	if ($mode == "admin") {
		$member_level = 1;
	} else if ($mode == "member") {
		$member_level = 3;
	}

	$sqli = "INSERT m_member SET mem_level=".$member_level.", mem_id='".$member_id."', mem_pw='".$member_pw."', mem_email='".$member_email."', mem_name='".$member_name."', mem_tel='".$member_tel."', mem_status='Y', join_date=NOW()";

	mysql_query($sqli) or die(mysql_error());
	mysql_close($connect);

	Error('신규 회원 정보가 등록되었습니다.', $moveUrl_i);

} else if ($processMode == "delete"){
	$sqli = "DELETE FROM m_member WHERE idx=".$mem_idx;

	mysql_query($sqli) or die(mysql_error());
	mysql_close($connect);

	Error('회원 정보가 정상적으로 삭제되었습니다.', $moveUrl_i);
}
?>