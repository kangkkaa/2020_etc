<? include_once "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<head>
<title><?=$rs['siteTitle']?></title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/button.css" rel="stylesheet" type="text/css">
<link href="css/basic.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
</head>
<body id="admin-wrapper" class="stretched">
<?
$page = "boardConfig";
include "inc/left.php"; 
$sqlList = "SELECT * FROM boardAdmin WHERE board_id != 'contactusOrionnet' ORDER BY reg_date DESC";
$resultAdmin = mysql_query($sqlList) or die (mysql_error());

$sql = "SELECT COUNT(*) total_count FROM boardAdmin WHERE board_id != 'contactusOrionnet'";
$rsco = mysql_fetch_array(mysql_query($sql));
$recordcount = $rsco['total_count'];

unset($rsco);
?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">게시판 설정</h3>
				<div class="col-full nobottommargin topmargin"><a href="boardInsert.php?mode=insert"><span class="button button-default btn-sm notopmargin"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;신규 게시판 생성</span></a></div>
				<div class="col-full">
					<form name="boardForm" action="?" method="get">
						<table class="table table-striped">
							<thead>
								<tr class="text-primary info">
									<th>게시판 아이디</th>
									<th>게시판 이름</th>
									<th>종류</th>
									<th>글쓰기 권한</th>
									<th>댓글 기능</th>
									<th>비밀글 기능</th>
									<th>사용 여부</th>
									<th>리스트 수</th>
									<th>수정/삭제</th>
								</tr>
							</thead>
							<tbody class="text-center">
<?
$i = 0;
while ($rsmin = mysql_fetch_array($resultAdmin)) {

	if($rsmin['secretYN']=="Y"){
		$secritYN ="<font class='text-success'>사용함</font>";
	}else if($rsmin['secretYN']=="N"){
		$secritYN="<font class='text-danger'>사용안함</font>";
	}

	if($rsmin['comment_yn']=="Y"){
		$comment_yn ="<font class='text-success'>사용함</font>";
	}else if($rsmin['comment_yn']=="N"){
		$comment_yn="<font class='text-danger'>사용안함</font>";
	}

	if($rsmin['status']=="Y"){
		$status ="<font class='text-success'>사용함</font>";
	}else if($rsmin['status']=="N"){
		$status="<font class='text-danger'>사용안함</font>";
	}

	if($rsmin['write_level']==1){
		$write_level="관리자만";
	}else if($rsmin['write_level']==3){
		$write_level="모두 허용";
	}

	if($rsmin['type_id']==1){
		$type="일반";
	}else if($rsmin['type_id']==2){
		$type="질문답변";
	}else if($rsmin['type_id']==3){
		$type="갤러리";
	}
 ?>
								<tr>
									<td><font class="text-info strong"><?=$rsmin['board_id']?></font></td>
									<td><?=$rsmin['board_name']?></td>
									<td><?=$type?></td>
									<td><?=$write_level?></td>
									<td><b><?=$comment_yn?></b></td>
									<td><b><?=$secritYN?></b></td>
									<td><b><?=$status?></b></td>
									<td><?=$rsmin['page_size']?></td>
									<td><button type="button" class="button button-primary btn-sm" onclick="boardModify(<?=$rsmin['idx']?>);"><i class="fa fa-wrench"></i></button> <button type="button" class="button button-danger btn-sm" onclick="boardDelete(<?=$rsmin['idx']?>, '<?=$rsmin['board_id']?>');"><i class="glyphicon glyphicon-trash"></i></button></td>
								</tr>

<?  $i++; } unset($rsmin); ?>
<? if($recordcount == 0){ ?>
								<tr>
									<td><font class="text-info strong">존재하는 게시판이 없습니다.</font></td>
									<td></td>
									<td></td>
									<td></td>
									<td><font class='text-success'><b></b></font></td>
									<td><font class='text-success'><b></b></font></td>
									<td><font class='text-success'><b></b></font></td>
									<td></td>
									<td></td>
								</tr>
<? } ?>
						</tbody>
						</table>
					<input type="hidden" name="bidx" value="">
					<input type="hidden" name="mode" value="">
					<input type="hidden" name="board_idvalue" value="">
					</form>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" language="javascript">
	// Side Menu
	$(document).ready(function() {
		$(".side-nav").accordion({
			accordion: false,
			speed: 200,
		});
	});
	// Scroll to Top
	$(window).scroll(function() {
		if($(this).scrollTop() > 450) {
			$('#gotoTop').fadeIn();
		} else {
			$('#gotoTop').fadeOut();
		}
	});
	$('#gotoTop').click(function() {
		$('body,html').animate({scrollTop:0},400);
		return false;
	});
</script>
<script type="text/javascript" language="javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="dist/js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script></body>
<script type="text/javascript">
var form = document.boardForm;

function boardModify(a) {
	form.bidx.value = a;
	form.mode.value = "modify";
	form.action = "boardInsert.php"
	form.submit();
	return true;
}
function boardDelete(a, b) {
	if (confirm('등록된 게시물도 같이 삭제되며 삭제된 게시판은 복구할 수 없습니다. 해당 게시판과 게시물을 삭제하시겠습니까?')==1) {
		form.bidx.value = a;
		form.board_idvalue.value = b;
		form.mode.value = "delete";
		form.method = "post";
		form.action = "boardProcess.php";
		form.submit();
		return true;
	}
}
</script>
</html>