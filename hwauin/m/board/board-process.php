<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include_once "_link.php";
include "../inc/class.image.php";

$ck = $_POST['ck'];
$mode = $_POST['mode'];
$boardID = $_POST['id'];
$search_text = $_POST['search_text'];
$type_id = $_POST['type_id'];
$npage = $_POST['npage'];
$maxfilesize = 10*1048576;
$memberID = $_SESSION['mobile']['admId'];
if($memberID==""){
	$memberID = "손님";
}
$b_id = $_SERVER['REMOTE_ADDR'];
$urlI="../sub.php?npage=".$npage."&id=".$boardID."&ck=".$ck."&search_text=".$search_text;
$subject = addslashes(htmlspecialchars($_POST['b_title']));
$writer = $_POST['b_writer'];
$pwd = addslashes(htmlspecialchars($_POST['b_passWord']));
$secretYN = $_POST['b_secretYN'];
$noticeYN = "N";
$content = addslashes(htmlspecialchars($_POST['b_content']));
if($secretYN == ""){
	$secretYN="N";
}

if($mode =="insert"){ //글등록
	$sql_bid = "SELECT MAX(b_id) b_id FROM boardTable";
	$rs_bid = mysql_fetch_array(mysql_query($sql_bid));

	if($rs_bid['b_id']==0){
		$b_idx = 1;
	}else{
		$b_idx = $rs_bid['b_id'] + 1;
	}
	unset($rs_bid);
	if($_FILES['userFile']['name']!=""){

		$file = $_FILES['userFile']['tmp_name'];
		$file_size = $_FILES['userFile']['size'];
		$file_type = $_FILES['userFile']['type'];
		$file_realname = $_FILES['userFile']['name'];

			$Imagefile = substr($file_type, 0, 5); //이미지파일인가아닌가
			$fileType = explode(".",$file_realname); //확장자명
			$saveFilename = date("Ymdhis")."f.".$fileType[1]; //파일저장명
			
			if ($Imagefile =="image"){
				$imgsize = @getimagesize($file); //이미지 파일 정보 가져오기
				$width = $imgsize[0]; //넓이
				$height = $imgsize[1]; //높이
			} else if ($type_id == 3) {
				Error('갤러리 게시판은 이미지만 첨부가능합니다.', $urlI);
			}

			if($file_size > $maxfilesize){
				Error('첨부가능한 용량은 10M까지만 허용됩니다', $urlI);
			}

			if($fileType[1]=="php" || $fileType[1]=="exe" || $fileType[1]=="com" || $fileType[1]=="msi" || $fileType[1]=="bat" || $fileType[1]=="php" || $fileType[1]=="html" || $fileType[1]=="js" || $fileType[1]=="mov" || $fileType[1]=="avi" || $fileType[1]=="asf" || $fileType[1]=="wmv" || $fileType[1]=="mp4" || $fileType[1]=="apk" || $fileType[1]=="sh" || $fileType[1]=="mpg" || $fileType[1]=="kor" || $fileType[1]=="htm" || $fileType[1]=="phps" || $fileType[1]=="asp" || $fileType[1]=="jsp"){
				mysql_close($connect);			
				Error("첨부가 불가능한 파일입니다.", $urlI);
			} else { 
			
					$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename;
					move_uploaded_file($file, $filePath);

					if ($Imagefile == "image") {
						if ($width > 900) {
							$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width(900); $thumb->save();
							$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename);
						} else {
							$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width($width); $thumb->save();
							}
					}
			}
	}

	$sql = "INSERT boardTable SET b_id=".$b_idx.", member_id='".$memberID."',board_id='".$boardID."', b_writerName='".$writer."', b_password='".$pwd."', b_subject='".$subject."', b_contents='".$content."', b_hit='0', b_step='', b_parent='".$b_idx."', b_noticeYN='N', b_ip='".$b_ip."', b_writeday=NOW(), b_commentCnt='0', b_secretYN='".$secretYN."', b_replyYN='N', b_replyCnt='0', file_names='".$saveFilename."', file_realnames='".addslashes(htmlspecialchars($file_realname))."', file_type='".$file_type."', file_size='".$file_size."'";

	mysql_query($sql) or die(mysql_error());

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
			include "../inc/syndi.php";
			naver_syndi_ping($boardID, $b_idx);
		}
	}

	Error("게시물이 정상적으로 저장되었습니다.", $urlI);

} else if($mode == "modify") {
	$b_idx = $_POST['b_idx'];
	$urlU = "../sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=B&mode=view&search_text=".$search_text;
	$urlP = "../write.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=B&mode=modify&search_text=".$search_text;
	//비밀번호 체크하기
	$pasql = "SELECT * FROM boardTable WHERE b_id= '".$b_idx."'";
	$pars = mysql_fetch_array(mysql_query($pasql));
	if($pars['b_password']!=$pwd){
		Error("비밀번호가 틀립니다.", $urlP);
	}

	$fileDeleteYN = $_POST['fileDeleteYN'];

	if($_FILES['userFile']['name']!=""){

		$file = $_FILES['userFile']['tmp_name'];
		$file_size = $_FILES['userFile']['size'];
		$file_type = $_FILES['userFile']['type'];
		$file_realname = $_FILES['userFile']['name'];

			$Imagefile = substr($file_type, 0, 5); //이미지파일인가아닌가
			$fileType = explode(".",$file_realname); //확장자명
			$saveFilename = date("Ymdhis")."f.".$fileType[1]; //파일저장명
		
			if ($Imagefile =="image"){
				$imgsize = @getimagesize($file); //이미지 파일 정보 가져오기
				$width = $imgsize[0]; //넓이
				$height = $imgsize[1]; //높이
			} else if ($type_id == 3) {
				Error('갤러리 게시판은 이미지만 첨부가능합니다.', $urlI);
			}

			if($file_size > $maxfilesize){
				Error('첨부가능한 용량은 10M까지만 허용됩니다', $urlI);
			}

			if($fileType[1]=="php" || $fileType[1]=="exe" || $fileType[1]=="com" || $fileType[1]=="msi" || $fileType[1]=="bat" || $fileType[1]=="php" || $fileType[1]=="html" || $fileType[1]=="js" || $fileType[1]=="mov" || $fileType[1]=="avi" || $fileType[1]=="asf" || $fileType[1]=="wmv" || $fileType[1]=="mp4" || $fileType[1]=="apk" || $fileType[1]=="sh" || $fileType[1]=="mpg" || $fileType[1]=="kor" || $fileType[1]=="htm" || $fileType[1]=="phps" || $fileType[1]=="asp" || $fileType[1]=="jsp"){
				mysql_close($connect);			
				Error("첨부가 불가능한 파일입니다.", $urlI);
			} else { 
			
					$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename;
					move_uploaded_file($file, $filePath);

					if ($Imagefile == "image") {
						if ($width > 900) {
							$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width(900); $thumb->save();
							$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename);
						} else {
							$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width($width); $thumb->save();
							}
					}

					if($fileDeleteYN =="Y"){
						$deleteFile = "../board/upload_files/".$_POST['nowFile'];
						@unlink($deleteFile);
					}
			}// 파일있나 없나 if끝

		$sqlUp= "UPDATE boardTable SET b_subject ='".$subject."', b_writerName='".$writer."', b_contents='".$content."', b_secretYN='".$secretYN."', file_names='".$saveFilename."', file_size ='".$file_size."', file_type='".$file_type."', file_realnames='".addslashes(htmlspecialchars($file_realname))."' WHERE b_id ='".$b_idx."'";

	}else{ //파일없음	
			
		if($fileDeleteYN =="Y"){
			$deleteFile = "../board/upload_files/".$_POST['nowFile'];
			@unlink($deleteFile);
			$sqlUp= "UPDATE boardTable SET b_subject ='".$subject."', b_writerName='".$writer."', b_contents='".$content."', b_secretYN='".$secretYN."', file_names='', file_size ='', file_type='', file_realnames='' WHERE b_id ='".$b_idx."'";

		}else{
			$sqlUp= "UPDATE boardTable SET b_subject ='".$subject."', b_writerName='".$writer."', b_contents='".$content."', b_secretYN='".$secretYN."' WHERE b_id ='".$b_idx."'";
		}
	}
	mysql_query($sqlUp) or die(mysql_error());

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
			include "../syndi/config/site.config.php";
			include "../syndi/libs/SyndicationHandler.class.php";
			include "../syndi/libs/SyndicationPing.class.php";

			$oPing = new SyndicationPing;
			$id = SyndicationHandler::getTag("article",  $boardID ,$b_idx);
			$oPing->setId($id);
			$oPing->request();
		}
	}
	Error("게시물 수정이 완료되었습니다.", $urlU);
}
?>