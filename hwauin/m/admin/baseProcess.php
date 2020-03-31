<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../inc/lib.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

$idx = $_POST['baseIdx'];
$site_title = htmlspecialchars(addslashes($_POST['s_title']));
$site_text = htmlspecialchars(addslashes($_POST['s_text']));
$site_address = htmlspecialchars(addslashes($_POST['s_address']));
$site_address2 = htmlspecialchars(addslashes($_POST['s_address2']));
$site_tel = htmlspecialchars(addslashes($_POST['s_tel']));
$site_time = htmlspecialchars(addslashes($_POST['s_time']));
$site_copy = htmlspecialchars(addslashes($_POST['s_copy']));
$s_mapmemo = htmlspecialchars(addslashes($_POST['s_mapmemo']));
$site_mapName = htmlspecialchars(addslashes($_POST['s_mapname']));


if ($site_title == "" || $site_address == "" || $site_tel == "" || $site_copy == "") {

	Error('필수 정보가 입력되지 않았습니다.', 'baseConfig.php');

} else {

	$sql = "UPDATE siteConfig SET siteTel='".$site_tel."', siteMemo='".$site_text."', siteCStime='".$site_time."', siteAddress='".$site_address."', siteAddress2='".$site_address2."', siteCopyright='".$site_copy."', siteTitle='".$site_title."', mapName='".$site_mapName."', mapMemo='".$s_mapmemo."' WHERE idx=".$idx;
	mysql_query($sql) or die(mysql_error());
	mysql_close($connect);

	Error('기본 정보가 정상적으로 변경되었습니다.', 'baseConfig.php');

}
?>