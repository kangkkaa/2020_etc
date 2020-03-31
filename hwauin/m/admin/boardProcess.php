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
if ($mode == "insert") {

	$bName = htmlspecialchars(addslashes(trim($_POST['boardName'])));
	$bKind = $_POST['boardKind'];
	$bId = trim($_POST['boardID']);
	$pSize = trim($_POST['pageSize']);
	$cYN = $_POST['commentYN'];
	$wLevel = $_POST['writeLevel'];
	$spamYN=$_POST['spam_YN'];
	$secretYN = $_POST['secretYN'];
	$siteTitle=$_POST['siteTitle'];
	$sqlIDcheck = "SELECT * FROM boardAdmin WHERE board_id='".$bId."'";
	$resultIDcheck = mysql_query($sqlIDcheck) or die (mysql_error());
	$rsIDcheck = mysql_fetch_array($resultIDcheck);
	$bMemo = $_POST['boardMemo'];
	$idx = $rsIDcheck['idx'];

	if ($rsIDcheck[1]) {

		mysql_close($connect);

		Error('생성되어 있는 게시판 아이디입니다. 다른 아이디를 사용해주세요.', 'boardConfig.php');

	} else {

		$sqlAdd = "INSERT boardAdmin SET board_id='".$bId."', type_id=".$bKind.", board_name='".$bName."', board_memo='".$bMemo."', page_size=".$pSize.", secretYN ='".$secretYN."', status='Y', reg_date=NOW(), write_level=".$wLevel.", comment_yn ='".$cYN."', siteTitle='".$siteTitle."'";
		mysql_query($sqlAdd) or die(mysql_error());

		$sqlContent = "INSERT contentConfig SET contentName='".$bName."', contentKind='B', contentId='".$bId."'";
		mysql_query($sqlContent) or die(mysql_error());

		//신디케이션
		$sqlsyn = "SELECT * FROM syndication WHERE idx=1";
		$rssyn = mysql_fetch_array(mysql_query($sqlsyn));

		if($rssyn['status']=="Y"){ //신디케이션 활성화가 되어있으면			
			include '../syndi/config/site.config.php';
			include '../syndi/libs/SyndicationHandler.class.php';
			include '../syndi/libs/SyndicationPing.class.php';

			$oPing = new SyndicationPing;
			$oPing->setId(SyndicationHandler::getTag('channel', $bId));
			$oPing->setType('article');		
			$oPing->request();
		}
		mysql_close($connect);

		Error('게시판이 등록되었습니다. 각 게시판별로 설정을 수정하실 수 있습니다.', 'boardConfig.php');
	}

} else if ($mode == "modify") {

	$idxNo = $_POST['bidx'];
	$bName = htmlspecialchars(addslashes(trim($_POST['boardName'])));
	$bKind = $_POST['boardKind'];
	$bId = trim($_POST['boardID']);
	$pSize = trim($_POST['pageSize']);
	$cYN = $_POST['commentYN'];
	$wLevel = $_POST['writeLevel'];
	$sYN = $_POST['statusYN'];
	$secretYN = $_POST['secretYN'];
	$bMemo = $_POST['boardMemo'];
	$siteTitle=$_POST['siteTitle'];

	$sqlUpdate = "UPDATE boardAdmin SET type_id='".$bKind."', board_name='".$bName."', board_memo='".$bMemo."', page_size=".$pSize.", status='".$sYN."', secretYN='".$secretYN."', write_level='".$wLevel."', comment_yn='".$cYN."', siteTitle='".$siteTitle."' WHERE idx=".$idxNo." AND board_id='".$bId."'";

	mysql_query($sqlUpdate) or die(mysql_error());

	$sqlUpContent = "UPDATE contentConfig SET contentName='".$bName."' WHERE contentId='".$bId."'";
	mysql_query($sqlUpContent) or die(mysql_error());
	mysql_close($connect);
	Error('게시판 설정이 저장되었습니다.', 'boardConfig.php');

} else if ($mode == "delete") {

	$bid = $_POST['bidx'];
	$board_idvalue = $_POST['board_idvalue'];

	$sql = "DELETE FROM boardAdmin WHERE idx=".$bid;
	mysql_query($sql) or die(mysql_error());

	$sql2 = "DELETE FROM boardTable WHERE board_id='".$board_idvalue."'";
	mysql_query($sql2) or die(mysql_error());

	$sql3 = "DELETE FROM contentConfig WHERE contentId='".$board_idvalue."'";
	mysql_query($sql3) or die(mysql_error());
	mysql_close($connect);
	Error('해당 게시판이 정상적으로 삭제되었습니다.', 'boardConfig.php');
}
?>