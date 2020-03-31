<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', '../index.php');
}

global $connect;
$connect = db_connect();
mysql_query('set names utf8');


$mode = $_POST['mode'];

$url = "../pageConfig.php";
$p_subject =  htmlspecialchars(addslashes($_POST['p_subject']));
$p_memo =  htmlspecialchars(addslashes($_POST['p_memo']));
$p_title =  htmlspecialchars(addslashes($_POST['p_title']));
$p_key =  htmlspecialchars(addslashes($_POST['p_key']));
$p_de =  htmlspecialchars(addslashes($_POST['p_de']));
$p_content =  htmlspecialchars(addslashes($_POST['p_content']));

$p_subject = $_POST['p_subject'];
$p_memo = $_POST['p_memo'];
$p_title = $_POST['p_title'];
$p_key = $_POST['p_key'];
$p_de = $_POST['p_de'];
$p_content = $_POST['content'];

$img_cnt = $_POST['attach_image_cnt'];
$file_cnt = $_POST['attach_file_cnt'];
$img_names = "";
$img_realnames = "";
$img_size = "";
$file_names = "";
$file_realnames = "";
$file_type = "";
$file_size = "";
for ($i=0; $i<$img_cnt; $i++) {
	$img_realnames = $img_realnames."::".strstr($_POST['attach_image'.$i], '20'); //업로드 폴더에 실제 업로드된 이름
	$img_names = $img_names."::".$_POST['attach_image_name'.$i]; //첨부 원본의 이름
	$img_size = $img_size."::".$_POST['attach_image_size'.$i];
}

for ($i=0; $i<$file_cnt; $i++) {
	$file_realnames = $file_realnames."::".strstr($_POST['attach_file'.$i], '20'); //업로드 폴더에 실제 업로드된 이름
	$file_names = $file_names."::".$_POST['attach_file_name'.$i]; //첨부 원본의 이름
	$file_type = $file_type."::".$_POST['attach_file_type'.$i];
	$file_size = $file_size."::".$_POST['attach_file_size'.$i];
}

if($mode =="insert"){

	$sql_pid = "SELECT MAX(idx) idx FROM pageTable";
	$rs_pid = mysql_fetch_array(mysql_query($sql_pid));

	if (!$rs_pid['idx']) {
		$p_id = 1;
	} else {
		$p_id = $rs_pid['idx']+1;
	}
	unset($rs_pid);

	$sql = "INSERT pageTable SET idx='".$p_id."', pageTitle='".$p_subject."', pageText='".$p_memo."', pagecontent='".$p_content."', siteTitle='".$p_title."', siteTag='".$p_key."', siteDescription='".$p_de."', createDay = NOW(), img_cnt='".$img_cnt."', img_names='".$img_names."', img_realnames='".$img_realnames."', img_size='".$img_size."', file_cnt='".$file_cnt."', file_names='".$file_names."', file_realnames='".$file_realnames."', file_type='".$file_type."', file_size='".$file_size."'";

	mysql_query($sql) or die(mysql_error());

	$sqlC = "INSERT contentConfig SET contentName ='".$p_subject."', contentKind='P', contentId='".$p_id."'";
	mysql_query($sqlC) or die(mysql_error());


	Error("컨텐츠가 정상적으로 등록되었습니다.", $url);

}else if($mode =="modify"){

	$p_id = $_POST['p_id'];
	$sql = "UPDATE pageTable SET pageTitle='".$p_subject."', pageText='".$p_memo."', pagecontent='".$p_content."', siteTitle='".$p_title."', siteTag='".$p_key."', siteDescription='".$p_de."', img_cnt='".$img_cnt."', img_names='".$img_names."', img_realnames='".$img_realnames."', img_size='".$img_size."', file_cnt='".$file_cnt."', file_names='".$file_names."', file_realnames='".$file_realnames."', file_type='".$file_type."', file_size='".$file_size."' WHERE idx='".$p_id."'";

	mysql_query($sql) or die(mysql_error());


	Error("컨텐츠가 정상으로 수정되었습니다.",$url);

}

?>