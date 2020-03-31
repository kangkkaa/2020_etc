<? include "../inc/lib.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<? include "../inc/class.image.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$idx = $_POST['logoIdx'];

if ($_FILES['userFile']['name']) {

	$file = $_FILES['userFile']['tmp_name'];
	$file_name = $_FILES['userFile']['name'];
	$file_size = $_FILES['userFile']['size'];
	$file_type = $_FILES['userFile']['type'];

	if (substr($file_type,0,5) == "image") {
		$imgsize = @getimagesize($file); 
		$width = $imgsize[0]; //입력받은 파일의 가로크기를 구합니다.
		$height = $imgsize[1]; //입력받은 파일의 세로크기를 구합니다.
	} else {
		Error('로고 파일은 이미지만 첨부가능합니다.', 'logoAdmin.php');
	}

	$s_file_name_exr = substr(strrchr($file_name,"."),1);
	$s_file_name = date("Ymdhis")."f.".$s_file_name_exr;

	if ($s_file_name_exr=="exe" || $s_file_name_exr=="com" || $s_file_name_exr=="msi" || $s_file_name_exr=="bat" || $s_file_name_exr=="php" || $s_file_name_exr=="html" || $s_file_name_exr=="js" || $s_file_name_exr=="mov" || $s_file_name_exr=="avi" || $s_file_name_exr=="asf" || $s_file_name_exr=="wmv" || $s_file_name_exr=="mp4" || $s_file_name_exr=="apk" || $s_file_name_exr=="sh" || $s_file_name_exr=="mpg" || $s_file_name_exr=="kor" || $s_file_name_exr=="htm" || $s_file_name_exr=="phps" || $s_file_name_exr=="asp" || $s_file_name_exr=="jsp") {

		mysql_close($connect);			
		Error('첨부할 수 없는 확장자의 파일입니다.', 'logoAdmin.php');

	} else {
		$filePath = $_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name;
		move_uploaded_file($file, $filePath);

		if (substr($file_type,0,5) == "image") {
			if ($width > 150) {
				$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width(150); $thumb->save();
				$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name);
			} else {
				$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/board/upload_files/".$s_file_name); $thumb->width($width); $thumb->save();
			}
		}

	}

	$sql = "UPDATE siteConfig SET siteLogo='".$s_file_name."' WHERE idx=".$idx;
	mysql_query($sql) or die(mysql_error());
	mysql_close($connect);

	Error('로고가 정상적으로 변경되었습니다.', 'logoAdmin.php');

} else {

	mysql_close($connect);
	Error('변경하고자 하는 로고 파일이 첨부되지 않았습니다.', 'logoAdmin.php');

}
?>