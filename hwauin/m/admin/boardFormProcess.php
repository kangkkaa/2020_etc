<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
include "../inc/class.image.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$boardID = $_POST['id'];
$mode = $_POST['mode'];
$npage = $_POST['npage'];
$type_id = $_POST['type_id'];
$maxfilesize = 10*1048576;
$noticeYN = $_POST['noticeYN'];
if($noticeYN ==""){
	$noticeYN="N";
}
if ($mode == "insert") {

	$sql_bid = "SELECT MAX(b_id) b_id FROM boardTable";
	$rs_bid = mysql_fetch_array(mysql_query($sql_bid));

	if (!$rs_bid['b_id']) {
		$b_idx = 1;
	} else {
		$b_idx = $rs_bid['b_id']+1;
	}
	unset($rs_bid);

	$boardID = $_POST['id'];
	$memberID = $_SESSION['mobile']['admId'];
	$writer = $_POST['b_writer'];// $_SESSION['mobile']['admName'];
	$subject = htmlspecialchars(addslashes($_POST['b_title']));
	$content = htmlspecialchars(addslashes($_POST['b_content']));
	$moveUrl = "board.php?npage=".$npage."&id=".$boardID;

	if ($_FILES['userFile']['name']) {

		$file = $_FILES['userFile']['tmp_name'];
		$file_name = $_FILES['userFile']['name'];
		$file_size = $_FILES['userFile']['size'];
		$file_type = $_FILES['userFile']['type'];

		if (substr($file_type,0,5) == "image") {
			$imgsize = @getimagesize($file); 
			$width = $imgsize[0]; //입력받은 파일의 가로크기를 구합니다.
			$height = $imgsize[1]; //입력받은 파일의 세로크기를 구합니다.
		} else if ($type_id == 3) {
			Error('갤러리 게시판은 이미지만 첨부가능합니다.', $moveUrl);
		}

		if ($file_size > $maxfilesize) {
			mysql_close($connect);
			Error('첨부파일 용량은 10M까지만 허용됩니다.', $moveUrl);
		}

		$s_file_name_exr = substr(strrchr($file_name,"."),1);
		$s_file_name = date("Ymdhis")."f.".$s_file_name_exr;

		if ($s_file_name_exr=="exe" || $s_file_name_exr=="com" || $s_file_name_exr=="msi" || $s_file_name_exr=="bat" || $s_file_name_exr=="php" || $s_file_name_exr=="html" || $s_file_name_exr=="js" || $s_file_name_exr=="mov" || $s_file_name_exr=="avi" || $s_file_name_exr=="asf" || $s_file_name_exr=="wmv" || $s_file_name_exr=="mp4" || $s_file_name_exr=="apk" || $s_file_name_exr=="sh" || $s_file_name_exr=="mpg" || $s_file_name_exr=="kor" || $s_file_name_exr=="htm" || $s_file_name_exr=="phps" || $s_file_name_exr=="asp" || $s_file_name_exr=="jsp") {

			mysql_close($connect);			
			Error('첨부할 수 없는 확장자의 파일입니다.', $moveUrl);

		} else {

			$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name;
			move_uploaded_file($file, $filePath);

			if (substr($file_type,0,5) == "image") {
				if ($width > 900) {
					$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width(900); $thumb->save();
					$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name);
				} else {
					$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width($width); $thumb->save();
				}
			}
		}
	}

	$sqlInsert = "INSERT boardTable SET b_id='".$b_idx."', member_id='".$memberID."', board_id='".$boardID."', b_writerName='".$writer."', b_password='', b_subject='".$subject."', b_contents='".$content."', b_hit='0', b_step='0', b_parent='".$b_idx."', b_noticeYN='".$noticeYN."', b_ip='".$_SERVER['REMOTE_ADDR']."', b_writeday=NOW(), b_commentCnt='0', b_secretYN='N', b_replyYN='N', b_replyCnt='0', file_names='".$s_file_name."', file_realnames='".addslashes(htmlspecialchars($file_name))."', file_type='".$file_type."', file_size='".$file_size."'";

	mysql_query($sqlInsert) or die(mysql_error());
	mysql_close($connect);
	Error('게시물이 정상적으로 등록되었습니다.', $moveUrl);

} else if ($mode == "modify") {

	$b_idx = $_POST['b_idx'];
	$writer = $_POST['b_writer'];
	$subject = htmlspecialchars(addslashes($_POST['b_title']));
	$content = htmlspecialchars(addslashes($_POST['b_content']));
	$moveUrl = "view.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&mode=view&search_text=".$_POST['search_text'];

	if ($_FILES['userFile']['name']) {

		$file = $_FILES['userFile']['tmp_name'];
		$file_name = $_FILES['userFile']['name'];
		$file_size = $_FILES['userFile']['size'];
		$file_type = $_FILES['userFile']['type'];

		if (substr($file_type,0,5) == "image") {
			$imgsize = @getimagesize($file); 
			$width = $imgsize[0]; //입력받은 파일의 가로크기를 구합니다.
			$height = $imgsize[1]; //입력받은 파일의 세로크기를 구합니다.
		} else if ($type_id == 3) {
			Error('갤러리 게시판은 이미지만 첨부가능합니다.', $moveUrl);
		}
		
		if ($file_size > $maxfilesize) {
			mysql_close($connect);
			Error('첨부파일 용량은 10M까지만 허용됩니다.', $moveUrl);
		}

		$s_file_name_exr = substr(strrchr($file_name,"."),1);
		$s_file_name = date("Ymdhis")."f.".$s_file_name_exr;

		if ($s_file_name_exr=="exe" || $s_file_name_exr=="com" || $s_file_name_exr=="msi" || $s_file_name_exr=="bat" || $s_file_name_exr=="php" || $s_file_name_exr=="html" || $s_file_name_exr=="js" || $s_file_name_exr=="mov" || $s_file_name_exr=="avi" || $s_file_name_exr=="asf" || $s_file_name_exr=="wmv" || $s_file_name_exr=="mp4" || $s_file_name_exr=="apk" || $s_file_name_exr=="sh" || $s_file_name_exr=="mpg" || $s_file_name_exr=="kor" || $s_file_name_exr=="htm" || $s_file_name_exr=="phps" || $s_file_name_exr=="asp" || $s_file_name_exr=="jsp") {

			mysql_close($connect);			
			Error('첨부할 수 없는 확장자의 파일입니다.', $moveUrl);

		} else {

			$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name;
			move_uploaded_file($file, $filePath);

			if (substr($file_type,0,5) == "image") {
				if ($width > 900) {
					$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width(900); $thumb->save();
					$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name);
				} else {
					$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width($width); $thumb->save();
				}
			}
		}

		if ($_POST['fileDeleteYN'] == "Y") {
			$unlinkString = "../board/upload_files/".$_POST['nowFile'];
			@unlink($unlinkString);
		}

		$sqlUpdate = "UPDATE boardTable SET b_subject='".$subject."',b_noticeYN='".$noticeYN."', b_contents='".$content."',b_writerName='".$writer."', file_names='".$s_file_name."', file_realnames='".addslashes(htmlspecialchars($file_name))."', file_type='".$file_type."', file_size='".$file_size."' WHERE b_id='".$b_idx."'";

	} else {

		if ($_POST['fileDeleteYN'] == "Y") {
			$unlinkString = "../board/upload_files/".$_POST['nowFile'];
			@unlink($unlinkString);

			$sqlUpdate = "UPDATE boardTable SET b_subject='".$subject."',b_writerName='".$writer."',b_noticeYN='".$noticeYN."', b_contents='".$content."', file_names='', file_realnames='', file_type='', file_size='' WHERE b_id='".$b_idx."'";
		}else{
			$sqlUpdate = "UPDATE boardTable SET b_subject='".$subject."',b_writerName='".$writer."',b_noticeYN='".$noticeYN."', b_contents='".$content."' WHERE b_id='".$b_idx."'";
		}
	}

	mysql_query($sqlUpdate) or die(mysql_error());
	mysql_close($connect);
	Error('게시물이 정상적으로 수정되었습니다.', $moveUrl);

} else if ($mode == "delete") {

	$boardID = $_POST['id'];
	$b_idx = $_POST['b_idx'];
	$moveUrl = "board.php?npage=".$npage."&id=".$boardID."&search_text=".$_POST['search_text'];

	$sqlreply = "SELECT * FROM boardTable WHERE b_id='".$b_idx."'"; //답글 확인
	$rers = mysql_fetch_array(mysql_query($sqlreply));

	if($rers['b_replyCnt']>0){//답글이 있을 때
			$sqlDelete = "DELETE FROM boardTable WHERE b_parent='".$b_idx."' AND board_id='".$boardID."'";
		}else{
			$sqlDelete = "DELETE FROM boardTable WHERE b_id='".$b_idx."' AND board_id='".$boardID."'";
		}
	mysql_query($sqlDelete) or die(mysql_error());

	$unlinkString = "../board/upload_files/".$_POST['nowFile'];
	@unlink($unlinkString);

	$sqlcomment = "DELETE FROM board_comment WHERE b_id='".$b_idx."'"; //덧글삭제
	mysql_query($sqlcomment) or die(mysql_error());
	mysql_close($connect);
	Error('게시물이 정상적으로 삭제되었습니다.', $moveUrl);

} else if ($mode =="replyInsert"){

	$urlCD = "view.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&mode=view&search_text=".$_POST['search_text'];

	$sql_bid = "SELECT MAX(b_id) b_id FROM boardTable";
	$rs_bid = mysql_fetch_array(mysql_query($sql_bid));

	if (!$rs_bid['b_id']) {
		$b_idx = 1;
	} else {
		$b_idx = $rs_bid['b_id']+1;
	}
	unset($rs_bid);

	$b_parent = $_POST['b_idx'];
	$writer = $_POST['r_writer'];
	$subject = $_POST['r_title'];
	$content = $_POST['r_content'];

	$sqltemp = "SELECT b_step,b_replyCnt FROM boardTable WHERE b_id=".$b_parent;
	$rstemp = mysql_fetch_array(mysql_query($sqltemp));
	$b_step= $rstemp['b_step'] +1;
	$b_reply_cnt = $rstemp['b_replyCnt'] + 1;
	unset($rstemp);

	$sqlInsert = "INSERT boardTable SET b_id='".$b_idx."', member_id='".$memberID."', board_id='".$boardID."', b_writerName='".$writer."', b_password='', b_subject='".$subject."', b_contents='".$content."', b_hit='0', b_step='".$b_step."', b_parent='".$b_parent."', b_noticeYN='".$noticeYN."', b_ip='".$_SERVER['REMOTE_ADDR']."', b_writeday=NOW(), b_commentCnt='0', b_secretYN='N', b_replyYN='N', b_replyCnt='0', file_names='".$s_file_name."', file_realnames='".addslashes(htmlspecialchars($file_name))."', file_type='".$file_type."', file_size='".$file_size."'";
	mysql_query($sqlInsert) or die(mysql_error());

	$sqlupdate = "UPDATE boardTable SET b_replyCnt='".$b_reply_cnt."', b_replyYN='Y' WHERE b_id=".$b_parent;
	mysql_query($sqlupdate) or die(mysql_error());

	Error("답글 등록이 완료되었습니다.", $urlCD);

}else if($mode=="replyModify"){ //답글수정

	$b_parent = $_POST['b_idx'];
	$r_idx = $_POST['r_idx'];
	$writer = $_POST['r_writer'];
	$subject = $_POST['r_title'];
	$content = $_POST['r_content'];
	$urlCD = "view.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&mode=view&search_text=".$_POST['search_text'];

	$sql = "UPDATE boardTable SET b_writerName='".$writer."', b_subject='".$subject."', b_contents='".$content."' WHERE b_id = '".$r_idx."' AND b_parent='".$b_parent."'";
	mysql_query($sql) or die(mysql_error());	
	Error("답글 수정이 완료되었습니다.", $urlCD);

}else if($mode=="replyDelete"){

	$b_parent = $_POST['b_idx'];
	$r_idx = $_POST['r_idx'];
	$urlCD = "view.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&mode=view&search_text=".$_POST['search_text'];

	$sql = "DELETE FROM boardTable WHERE b_id = '".$r_idx."' AND b_parent='".$b_parent."'";
	mysql_query($sql) or die(mysql_error());	

	$sqlupdate = "UPDATE boardTable SET b_replyCnt = b_replyCnt-1 WHERE b_id ='".$b_parent."'";
	mysql_query($sqlupdate) or die(mysql_error());	

	Error("답글 삭제가 완료되었습니다.", $urlCD);

}else if ($mode =="commentDelete"){

	$c_idx = $_POST['c_idx'];

	$urlCD = "view.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&mode=view&search_text=".$_POST['search_text'];

	$cDsql= "DELETE FROM board_comment WHERE board_id='".$boardID."' AND c_id='".$c_idx."'";
	mysql_query($cDsql) or die(mysql_error());

	$sqlB = "UPDATE boardTable SET b_commentCnt = b_commentCnt-1 WHERE board_id='".$boardID."' AND b_id='".$b_idx."'";
	mysql_query($sqlB) or die(mysql_error());

	Error("덧글 삭제가 완료되었습니다.", $urlCD);		
}
?>