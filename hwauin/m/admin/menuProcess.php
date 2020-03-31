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
$mainMenu = $_POST['mainMenu'];
$menuName = htmlspecialchars(addslashes($_POST['menuName']));
$menuMemo = htmlspecialchars(addslashes($_POST['menuMemo']));
$contentValue = htmlspecialchars(addslashes($_POST['contentValue']));
$linkConf = htmlspecialchars(addslashes($_POST['linkConf']));
$url = "../admin/menuConfig.php";
if ($mode=="insert"){
	$dept = $_POST['menuKind'];
	$sqlidx = "SELECT MAX(idx) idx FROM menuAdmin";
	$idxrs = mysql_fetch_array(mysql_query($sqlidx));

	if($idxrs['idx']==0){
		$idx =1;
	}else{
		$idx = $idxrs['idx']+1;
	}
	if($dept==2){
		$sqlNo = "SELECT MAX(sortNo) sortNo FROM menuAdmin WHERE dept='2' AND mainMenu='".$mainMenu."' ";
		$idxNo = mysql_fetch_array(mysql_query($sqlNo));
	}else{
		$sqlNo = "SELECT MAX(sortNo) sortNo FROM menuAdmin WHERE dept='1'";
		$idxNo = mysql_fetch_array(mysql_query($sqlNo));
	}
	if($idxNo['sortNo']==0){
		$sortNo = 1;
	}else{
		$sortNo = $idxNo['sortNo']+1;
	}

	if($dept ==1){ //대메뉴 생성
		$sql = "INSERT menuAdmin SET idx='".$idx."', dept='".$dept."', writeday=NOW(), mainMenu='".$mainMenu."', menuName='".$menuName."', menuMemo='".$menuMemo."', contentIdx='".$contentValue."', target='".$linkConf."', sortNo='".$sortNo."', subUseYN='N'";
	}else if($dept==2){ //소메뉴 생성
		$sql = "INSERT menuAdmin SET idx='".$idx."', dept='".$dept."', writeday=NOW(), mainMenu='".$mainMenu."', menuName='".$menuName."', menuMemo='".$menuMemo."', contentIdx='".$contentValue."', target='".$linkConf."', sortNo='".$sortNo."', subUseYN='N'";
		$updatesql = "UPDATE menuAdmin SET subUseYN='Y' WHERE idx='".$mainMenu."' AND dept=1";
		mysql_query($updatesql) or die(mysql_error());
	}
mysql_query($sql) or die(mysql_error());

Error("게시판 메뉴가 추가되었습니다.", $url);

}else if($mode=="modify"){
	$midx = $_POST['midx'];
	$sql = "UPDATE menuAdmin SET mainMenu='".$mainMenu."', menuName='".$menuName."', menuMemo='".$menuMemo."', contentIdx='".$contentValue."', target='".$linkConf."' WHERE idx='".$midx."'";
	mysql_query($sql) or die(mysql_error());
	Error("게시판 메뉴가 수정되었습니다.", $url);
}else if($mode=="delete"){
	$midx = $_POST['midx'];
	//삭제할 글의 정보
	$sqlNo = "SELECT * FROM menuAdmin WHERE idx='".$midx."'";
	$idxNo = mysql_fetch_array(mysql_query($sqlNo));
	//삭제할 글과 깊이과 같은 글들 찾아오기
	$sqlno = "SELECT * FROM menuAdmin WHERE mainMenu='".$idxNo['mainMenu']."' AND dept='".$idxNo['dept']."' AND (idx !='".$midx."')";
	$result = mysql_query($sqlno) or die(mysql_error());
	while($rs = mysql_fetch_array($result)){ //while문 돌리면서 숫자 높은것들 -1씩 해주기(메뉴 정렬을 위해)
		if($idxNo['sortNo']<$rs['sortNo']){
			$upsql = "UPDATE menuAdmin SET sortNo=sortNo-1 WHERE idx='".$rs['idx']."' AND mainMenu='".$idxNo['mainMenu']."' AND dept='".$idxNo['dept']."' AND (idx !='".$midx."')";
			mysql_query($upsql) or die(mysql_error());
		}
	}
	$sql = "DELETE FROM menuAdmin WHERE idx = '".$midx."'";
	if($idxNo['dept']==1){
		$subsql = "DELETE FROM menuAdmin WHERE mainMenu='".$midx."'";
		mysql_query($subsql) or die(mysql_error());
	}
	mysql_query($sql) or die(mysql_error());
	Error("게시판 메뉴가 삭제되었습니다.", $url);
}
?>