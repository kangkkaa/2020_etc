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

$mode = $_POST['mode'];
$idx = $_POST['idx'];
$main_text = $_POST['main_text'];
$main_subtext = $_POST['main_subtext'];
$sortNum = $_POST['sortNum'];
$contentValue = $_POST['contentValue'];
$url ="../admin/mainSlider.php";
$maxfilesize = 10*1048576;

if($mode =="insert"){
	if($_FILES['userFile']['name']){
		$file = $_FILES['userFile']['tmp_name'];
		$file_type =  $_FILES['userFile']['type'];
		$file_realname = $_FILES['userFile']['name'];
		$file_size = $_FILES['userFile']['size'];

		$fileType = explode(".",$file_realname); //확장자명
		$saveFilename = date("Ymdhis")."f.".$fileType[1]; //파일저장명
		$type = substr($file_type, 0, 5); //이미지파일인가아닌가
			if($type=="image"){
				$imgsize = @getimagesize($file); //이미지 파일 정보 가져오기
				$width = $imgsize[0]; //넓이
				$height = $imgsize[1]; //높이
			}else{
				Error('이미지만 첨부하실 수 있습니다.',$url);
			}
			if($file_size > $maxfilesize){
				Error('첨부가능한 용량은 10M까지만 허용됩니다', $url);
			}else{
					$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename;
					move_uploaded_file($file, $filePath); //파일저장

					if ($width > 900) {
						$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width(900); $thumb->save();
						$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename);
					} else {
						$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width($width); $thumb->save();
						}
			}
	}else{
		Error('이미지가 첨부되지 않았습니다.',$url);
	}

	$sql = "INSERT imageSlider SET mainImage_Title='".$main_text."',mainText='".$main_subtext."', mainImage_link='".$contentValue."', sortNo='".$sortNum."',file_name='".$saveFilename."', file_realname='".$file_realname."', file_type='".$file_type."', file_size='".$file_size."'";
	mysql_query($sql) or die(mysql_error());
	Error('이미지 슬라이드가 추가되었습니다.',$url);
}else if($mode =="modify"){
	
	if($_FILES['userFile']['name']){
		$sqlFile = "SELECT * FROM imageSlider WHERE idx='".$idx."'";
		$rsFile = mysql_fetch_array(mysql_query($sqlFile));

		$deleteFile = "../board/upload_files/".$rsFile['file_name'];
		@unlink($deleteFile);

		$file = $_FILES['userFile']['tmp_name'];
		$file_type =  $_FILES['userFile']['type'];
		$file_realname = $_FILES['userFile']['name'];
		$file_size = $_FILES['userFile']['size'];

		$fileType = explode(".",$file_realname); //확장자명
		$saveFilename = date("Ymdhis")."f.".$fileType[1]; //파일저장명
		$type = substr($file_type, 0, 5); //이미지파일인가아닌가
			if($type=="image"){
				$imgsize = @getimagesize($file); //이미지 파일 정보 가져오기
				$width = $imgsize[0]; //넓이
				$height = $imgsize[1]; //높이
			}else{
				Error('이미지만 첨부하실 수 있습니다.',$url);
			}
			if($file_size > $maxfilesize){
				Error('첨부가능한 용량은 10M까지만 허용됩니다', $url);
			}else{
					$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename;
					move_uploaded_file($file, $filePath); //파일저장

					if ($width > 900) {
						$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width(900); $thumb->save();
						$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename);
					} else {
						$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$saveFilename); $thumb->width($width); $thumb->save();
						}
				}
		$sqlU = "UPDATE imageSlider SET mainImage_Title='".$main_text."',mainText='".$main_subtext."', mainImage_link='".$contentValue."', sortNo='".$sortNum."',file_name='".$saveFilename."', file_realname='".$file_realname."', file_type='".$file_type."', file_size='".$file_size."' WHERE idx ='".$idx."'";
	}else{
		$sqlU = "UPDATE imageSlider SET mainImage_Title='".$main_text."',mainText='".$main_subtext."', mainImage_link='".$contentValue."', sortNo='".$sortNum."' WHERE idx ='".$idx."'";
	}
	

		mysql_query($sqlU) or die(mysql_error());

	Error('이미지 슬라이드가 수정되었습니다.',$url);
}else if($mode =="delete"){
	$sqlFile = "SELECT * FROM imageSlider WHERE idx='".$idx."'";
	$rsFile = mysql_fetch_array(mysql_query($sqlFile));

	$deleteFile = "../board/upload_files/".$rsFile['file_name'];
	@unlink($deleteFile);

	$sqlD ="DELETE FROM imageSlider WHERE idx = '".$idx."'";
	mysql_query($sqlD) or die(mysql_error());
	Error('이미지 슬라이드가 삭제되었습니다.',$url);

}
?>