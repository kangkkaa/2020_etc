<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include_once "_link.php";

$mode = $_POST['mode']; 
$npage = $_POST['npage'];
$b_idx = $_POST['b_idx'];
$c_idx = $_POST['c_idx'];
$ck = $_POST['ck'];
$search_text = $_POST['search_text'];
$nowFile = $_POST['nowFile'];
$boardID = $_POST['id'];
$pwd = $_POST['pwd'];

$urlL = "sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=".$ck."&search_text=".$search_text;
$urlP ="password.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=".$ck."&mode=".$mode."&search_text=".$search_text;
$urlV = "sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=".$ck."&mode=".$mode."&search_text=".$search_text;
$urlCD = "sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=".$ck."&mode=view&search_text=".$search_text;

$sql = "SELECT * FROM boardTable WHERE b_id ='".$b_idx."'";
$rs = mysql_fetch_array(mysql_query($sql));

if($mode =="view"){
	if($rs['b_password'] == $pwd){
?>
	<script>
		location.href="<?=$urlV?>";
	</script>
<?
	}else{
		Error("비밀번호가 맞지 않습니다.", $urlP);
	}
	mysql_query($sqlD) or die(mysql_error());

}else if($mode =="delete"){
	if($rs['b_password'] == $pwd){
		$deleteFile = "upload_files/".$_POST['nowFile'];
		@unlink($deleteFile);
		$sqlD = "DELETE FROM boardTable WHERE b_id='".$b_idx."'";	

		//신디케이션
		$sqlsyn = "SELECT * FROM syndication WHERE idx=1";
		$rssyn = mysql_fetch_array(mysql_query($sqlsyn));
		if($rssyn['status']=="Y"){ //신디케이션 활성화가 되어있으면
			//핑 제외 테이블 체크
			$excepttable = $rssyn['exceptTable'];
			$exceptTable = explode(",",$excepttable);
			$n = count($exceptTable) -1;

			for ($i=0; $i<=$n; $i++){
				if($exceptTable[$i]==$boardID){ //테이블이 핑제외됐는지 체크하는 부분
					//신디케이션 핑보낼지 말지 확인
					$syndiok = "N";
					break;
				}else{
					$syndiok = "Y";
				}
			}
			if($syndiok=="Y"){ //신디케이션 핑보내기
				include "syndi/config/site.config.php";
				include "syndi/libs/SyndicationHandler.class.php";
				include "syndi/libs/SyndicationPing.class.php";

				$link = "http://".$GLOBALS['syndi_tag_domain']."/sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=B&mode=view&search_text=".$search_text;
				$resql = "SELECT * FROM boardTable WHERE board_id='".$boardID."' AND b_id='".$b_idx."'"; 
				$rers = mysql_fetch_array(mysql_query($resql));

				$in_sql="INSERT syndi_delete_content_log SET content_id=".$b_idx.", bbs_id='".$boardID."', delete_date=NOW(), title='".$rers['b_subject']."', link_alternative='".$link."'";
				mysql_query($in_sql) or die(mysql_error()); //글 삭제 전 먼저 신디케이션 삭제 Table에 로그를 남긴다.
				unset($in_sql);

				$oPing = new SyndicationPing; 
				$id = SyndicationHandler::getTag("article", $boardID, $b_idx);
				$oPing->setId($id);
				$oPing->setType('deleted');
				$oPing->request();
			}
		}
		mysql_query($sqlD) or die(mysql_error());
		Error("게시물 삭제가 완료되었습니다.", $urlL);
	}else{
		Error("비밀번호가 맞지 않습니다.", $urlP);
	}
}else if($mode =="commentDelete"){ //덧글삭제
	$sqlc = "SELECT * FROM board_comment WHERE c_id ='".$c_idx."'";
	$rsc = mysql_fetch_array(mysql_query($sqlc));
	if($rsc['c_password'] != $pwd){
		echo $rsc['c_password'];
		exit;
		Error("비밀번호가 맞지 않습니다.", $urlP);
	}else{
		$cDsql= "DELETE FROM board_comment WHERE board_id='".$boardID."' AND c_id='".$c_idx."'";
		mysql_query($cDsql) or die(mysql_error());
		$sqlB = "UPDATE boardTable SET b_commentCnt = b_commentCnt-1 WHERE board_id='".$boardID."' AND b_id='".$b_idx."'";
		mysql_query($sqlB) or die(mysql_error());
		Error("덧글 삭제가 완료되었습니다.", $urlCD);
	}
}
?>