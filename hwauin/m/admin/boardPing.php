<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include_once "../inc/link.php";
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
global $connect;
$connect = db_connect();
mysql_query('set names utf8');

//신디케이션
$sqlsyn = "SELECT * FROM syndication WHERE idx=1";
$rssyn = mysql_fetch_array(mysql_query($sqlsyn));
if($rssyn['status']=="Y"){ //신디케이션 활성화가 되어있으면
	//핑 제외 테이블 체크
	$excepttable = $rssyn['exceptTable'];
	$exceptTable = explode(",",$excepttable);
	$n = count($exceptTable) -1;

	include '../syndi/config/site.config.php';
	include '../syndi/libs/SyndicationHandler.class.php';
	include '../syndi/libs/SyndicationPing.class.php';

	$sql = "SELECT * FROM boardAdmin";
	$result = mysql_query($sql) or die(mysql_error());

	while($rs = mysql_fetch_array($result)){
		for ($i=0; $i<=$n; $i++){
			if($exceptTable[$i]==$rs['board_id']){ //테이블이 핑제외됐는지 체크하는 부분
				//신디케이션 핑보낼지 말지 확인
				$syndiok = "N";
				break;
			}else{
				$syndiok = "Y";
			}
		}
		if($syndiok=="Y"){ //신디케이션 핑보내기
			$oPing = new SyndicationPing;
			$oPing->setId(SyndicationHandler::getTag('channel', $rs['board_id']));
			$oPing->setType('article');		
			$oPing->request();
		}
	}//while
}//if
Error("정상적으로 게시판핑이 전송되었습니다.", 'ping.php');
?>