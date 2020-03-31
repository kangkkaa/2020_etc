<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$midx = $_POST['midx']; //url을 위한 번호
$mode = $_POST['mode'];
$ridx = $_POST['ridx'];
$sortnum = $_POST['sortnum'];
$url = "menuSort.php?midx=".$midx;

$mainsql = "SELECT * FROM menuAdmin WHERE idx='".$ridx."'";
$mrs = mysql_fetch_array(mysql_query($mainsql));
$countsql = "SELECT MAX(sortNo) sortNo From menuAdmin WHERE mainMenu='".$mrs['mainMenu']."'";
$crs = mysql_fetch_array(mysql_query($countsql));

if($mode=="mup"){
	
	if($sortnum==1){
		Error("해당 메뉴는 정렬 최상위 또는 최하위 순서에 위치해 있습니다.", $url);
	}else{

	//올릴 시 중복되는거 찾기.
	$sort = $sortnum - 1;
	$sqlno = "SELECT * FROM menuAdmin WHERE sortNo= '".$sort."' AND mainMenu='".$mrs['mainMenu']."'";
	$rsno = mysql_fetch_array(mysql_query($sqlno));
	
	//중복되는 애 내려주기
	$upsql = "UPDATE menuAdmin SET sortNo=sortNo+1 WHERE idx='".$rsno['idx']."'";
	mysql_query($upsql) or die(mysql_error());
	//이제 진짜 내려주기
	$updqsql = "UPDATE menuAdmin SET sortNo='".$sort."' WHERE idx='".$ridx."'";
	mysql_query($updqsql) or die(mysql_error());
?>
	<script>
		location.href="<?=$url?>";
	</script>
<?
exit;	}
}else if($mode=="mdown"){

	if($sortnum==$crs['sortNo']){
		Error("해당 메뉴는 정렬 최상위 또는 최하위 순서에 위치해 있습니다.", $url);
	}else{

	//올릴 시 중복되는거 찾기.
	$sort = $sortnum + 1;
	$sqlno = "SELECT * FROM menuAdmin WHERE sortNo= '".$sort."' AND mainMenu='".$mrs['mainMenu']."'";
	$rsno = mysql_fetch_array(mysql_query($sqlno));
	
	//중복되는 애 내려주기
	$upsql = "UPDATE menuAdmin SET sortNo=sortNo-1 WHERE idx='".$rsno['idx']."'";
	mysql_query($upsql) or die(mysql_error());
	
	//이제 진짜 내려주기
	$updqsql = "UPDATE menuAdmin SET sortNo='".$sort."' WHERE idx='".$ridx."'";
	mysql_query($updqsql) or die(mysql_error());
?>
	<script>
		location.href="<?=$url?>";
	</script>
<?
exit;	}
}else if($mode=="sup"){
	
	if($sortnum==1){
		Error("해당 메뉴는 정렬 최상위 또는 최하위 순서에 위치해 있습니다.", $url);
	}else{

	//올릴 시 중복되는거 찾기.
	$sort = $sortnum - 1;
	$sqlno = "SELECT * FROM menuAdmin WHERE sortNo= '".$sort."' AND mainMenu='".$mrs['mainMenu']."'";
	$rsno = mysql_fetch_array(mysql_query($sqlno));
	
	//중복되는 애 내려주기
	$upsql = "UPDATE menuAdmin SET sortNo=sortNo+1 WHERE idx='".$rsno['idx']."'";
	mysql_query($upsql) or die(mysql_error());
	
	//이제 진짜 내려주기
	$updqsql = "UPDATE menuAdmin SET sortNo='".$sort."' WHERE idx='".$ridx."'";
	mysql_query($updqsql) or die(mysql_error());
?>
	<script>
		location.href="<?=$url?>";
	</script>
<?
exit;	}
}else if($mode=="sdown"){

	if($sortnum==$crs['sortNo']){
		Error("해당 메뉴는 정렬 최상위 또는 최하위 순서에 위치해 있습니다.", $url);
	}else{

	//올릴 시 중복되는거 찾기.
	$sort = $sortnum + 1;
	$sqlno = "SELECT * FROM menuAdmin WHERE sortNo= '".$sort."' AND mainMenu='".$mrs['mainMenu']."'";
	$rsno = mysql_fetch_array(mysql_query($sqlno));
	
	//중복되는 애 내려주기
	$upsql = "UPDATE menuAdmin SET sortNo=sortNo-1 WHERE idx='".$rsno['idx']."'";
	mysql_query($upsql) or die(mysql_error());
	
	//이제 진짜 내려주기
	$updqsql = "UPDATE menuAdmin SET sortNo='".$sort."' WHERE idx='".$ridx."'";
	mysql_query($updqsql) or die(mysql_error());
?>
	<script>
		location.href="<?=$url?>";
	</script>
<?
exit;	}
}
?>