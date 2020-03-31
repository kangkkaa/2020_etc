<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>첨부</title>
<script src="../../js/popup.js" type="text/javascript" charset="utf-8"></script>
<?php
error_reporting(E_ALL);
include "../../../inc/class.image.php";

if ($_POST['uploadKind'] == "I") {
	if ($_FILES['uploadFile']['name']) {
		$file = $_FILES['uploadFile']['tmp_name'];
		$file_name = $_FILES['uploadFile']['name'];
		$file_size = $_FILES['uploadFile']['size'];
		$file_type = $_FILES['uploadFile']['type'];

		if (substr($file_type,0,5) == "image") {
			$imgsize = @getimagesize($file); 
			$width = $imgsize[0]; //입력받은 파일의 가로크기를 구합니다.
			$height = $imgsize[1]; //입력받은 파일의 세로크기를 구합니다.
		} else {
			echo "<script>alert('이미지파일만 첨부가능합니다.'); history.back();</script>";
			exit;
		}

		$s_file_name_exr = substr(strrchr($file_name,"."),1);
		$s_file_name = date("Ymdhis")."i.".$s_file_name_exr;

		$filePath = $_SERVER['DOCUMENT_ROOT']."/nano/upload_files/".$s_file_name;
		move_uploaded_file($file, $filePath);

		if ($width > 900) {
			$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/nano/upload_files/".$s_file_name); $thumb->width(900); $thumb->save();
			$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/nano/upload_files/".$s_file_name);
		} else {
			$thumb = new Image($_SERVER['DOCUMENT_ROOT']."/nano/upload_files/".$s_file_name); $thumb->width($width); $thumb->save();
		}
	} else {
		echo "<script>alert('첨부된 파일이 없습니다.'); history.back();</script>";
		exit;
	}
?>

<script type="text/javascript">
function done() {
	if (typeof(execAttach) == 'undefined') {
		return;
	}
	
	var _mockdata = {
		'imageurl': 'http://<?=$_SERVER['HTTP_HOST']?>/nano/upload_files/<?=$s_file_name?>',
		'filename': '<?=$file_name?>',
		'filesize': <?=$file_size?>,
		'imagealign': 'L',
		'originalurl': 'http://<?=$_SERVER['HTTP_HOST']?>/nano/upload_files/<?=$s_file_name?>',
		'thumburl': ''
	};
	execAttach(_mockdata);
	closeWindow();
}

function initUploader(){
	var _opener = PopupUtil.getOpener();
	if (!_opener) {
		alert('잘못된 경로로 접근하셨습니다.');
		return;
	}
	
	var _attacher = getAttacher('image', _opener);
	registerAction(_attacher);

	done();
}
</script>

<?
} else if ($_POST['uploadKind'] == "F") {
	if ($_FILES['uploadFile']['name']) {
		$file = $_FILES['uploadFile']['tmp_name'];
		$file_name = $_FILES['uploadFile']['name'];
		$file_size = $_FILES['uploadFile']['size'];
		$file_type = $_FILES['uploadFile']['type'];

		$s_file_name_exr = substr(strrchr($file_name,"."),1);
		$s_file_name = date("Ymdhis")."f.".$s_file_name_exr;

		$filePath = $_SERVER['DOCUMENT_ROOT']."/nano/upload_files/".$s_file_name;
		move_uploaded_file($file, $filePath);
	} else {
		echo "<script>alert('첨부된 파일이 없습니다.'); history.back();</script>";
		exit;
	}
?>

<script type="text/javascript">
function done() {
	if (typeof(execAttach) == 'undefined') { //Virtual Function
		return;
	}
	
	var _mockdata = {
		'attachurl': 'http://<?=$_SERVER['HTTP_HOST']?>/nano/upload_files/<?=$s_file_name?>',
		'filemime': '<?=$file_type?>',
		'filename': '<?=$file_name?>',
		'filesize': <?=$file_size?>
	};
	execAttach(_mockdata);
	closeWindow();
}

function initUploader(){
	var _opener = PopupUtil.getOpener();
	if (!_opener) {
		alert('잘못된 경로로 접근하셨습니다.');
		return;
	}
	
	var _attacher = getAttacher('file', _opener);
	registerAction(_attacher);

	done();
}
</script>

<?
}
?>
</head>

<body onload="initUploader();"></body>
</html>