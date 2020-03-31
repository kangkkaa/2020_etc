<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$mainIdx = $_POST['mainIdx'];
$imageYN = $_POST['imageYN'];
if($imageYN ==""){
	$imageYN="N";
}
$service1_YN = $_POST['service1_YN'];
if($service1_YN ==""){
	$service1_YN="N";
}
$service_text1 = htmlspecialchars(addslashes($_POST['service_text1']));
$service_subtext1 = htmlspecialchars(addslashes($_POST['service_subtext1']));
$contentValue1 = $_POST['contentValue1'];
$service2_YN = $_POST['service2_YN'];
if($service2_YN ==""){
	$service2_YN="N";
}
$service_text2 = htmlspecialchars(addslashes($_POST['service_text2']));
$service_subtext2 = htmlspecialchars(addslashes($_POST['service_subtext2']));
$contentValue2 = $_POST['contentValue2'];
$service3_YN = $_POST['service3_YN'];
if($service3_YN ==""){
	$service3_YN="N";
}
$service_text3 = htmlspecialchars(addslashes($_POST['service_text3']));
$service_subtext3 = htmlspecialchars(addslashes($_POST['service_subtext3']));
$contentValue3 = $_POST['contentValue3'];
$siteTitle = htmlspecialchars(addslashes($_POST['siteTitle']));
$siteTag = htmlspecialchars(addslashes($_POST['siteTag']));
$siteDescription = htmlspecialchars(addslashes($_POST['siteDescription']));
$board_useYN = $_POST['board_useYN'];
if($board_useYN ==""){
	$board_useYN="N";
}
$b_contentValue = $_POST['b_contentValue'];


$sql_up = "UPDATE mainConfig SET mainimageYN='".$imageYN."', service1_YN='".$service1_YN."', serviceTitle1 ='".$service_text1."', serviceText1='".$service_subtext1."', service1_link='".$contentValue1."', service2_YN='".$service2_YN."', serviceTitle2='".$service_text2."', serviceText2='".$service_subtext2."', service2_link='".$contentValue2."', service3_YN='".$service3_YN."', serviceTitle3 ='".$service_text3."', serviceText3='".$service_text3."', service3_link='".$contentValue3."', board_useYN='".$board_useYN."', b_contentValue='".$b_contentValue."', siteTitle='".$siteTitle."', siteTag='".$siteTag."', siteDescription='".$siteDescription."' WHERE idx = '".$mainIdx."'";


mysql_query($sql_up) or die(mysql_error());
Error("메인 페이지 설정이 저장되었습니다.",'mainPage.php');
?>