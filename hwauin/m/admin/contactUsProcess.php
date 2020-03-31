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
$b_idx = $_POST['b_idx'];
$npage = $_POST['npage'];
$search_text = $_POST['search_text'];
$url = "contactUs.php?npage=".$npage."&search_text=".$search_text;

$menu_YN = $_POST['menu_YN'];
if($menu_YN==""){
	$menu_YN = "N";
}
$menu_title = $_POST['menu_title'];
$menu_memo = $_POST['menu_memo'];
$site_title = $_POST['site_title'];

if($mode=="delete"){
	$sql = "DELETE FROM boardTable WHERE b_id ='".$b_idx."'";
	mysql_query($sql) or die(mysql_error());
	Error("문의/상담 글이 정상적으로 삭제되었습니다.", $url);

}else if($mode=="menuConfig"){
	$sql = "UPDATE boardAdmin SET status='".$menu_YN."', board_name='".$menu_title."', board_memo='".$menu_memo."', siteTitle='".$site_title."' WHERE board_id='contactusOrionnet'";
	mysql_query($sql) or die(mysql_error());
	Error("문의/상담 게시판 설정이 수정되었습니다.", $url);
}
?>