<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$sqlP = "SELECT * FROM pageTable ORDER BY createDay";
$resultP = mysql_query($sqlP) or die(mysql_error());

$sql_pc = "SELECT COUNT(*) total_count FROM pageTable";
$rs_pc = mysql_fetch_array(mysql_query($sql_pc));
$recordcount = $rs_pc['total_count'];
unset($rs_pc);
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<head>
<title><?=$rs['siteTitle']?></title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css">
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
$page = "pageConfig";
include "inc/left.php"; ?>	
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">페이지 내용 설정</h3>
				<div class="col-full nobottommargin topmargin"><a href="pageInsert.php?mode=insert"><span class="button button-default btn-sm notopmargin"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;컨텐츠 페이지 생성</span></a></div>
				<div class="col-full">
					<form name="pageForm" action="" method="post">
						<table class="table table-striped">
							<thead>
								<tr class="text-primary info">
									<th>No</th>
									<th>페이지 제목</th>
									<th>페이지 설명</th>
									<th>페이지보기</th>
									<th>생성일</th>
									<th>수정/삭제</th>
								</tr>
							</thead>
							<tbody class="text-center">
<? 
$j=1;
while($rsp = mysql_fetch_array($resultP)){ ?>
								<tr>
									<td><?=$j?></td>
									<td><?=htmlspecialchars($rsp['pageTitle'])?></td>
									<td><?=htmlspecialchars($rsp['pageText'])?></td>
									<td><a href="../sub.php?ck=P&id=<?=$rsp['idx']?>" target="_blank"><span class="button button-warning btn-sm">새창으로 페이지보기</span></a></td>
									<td><?=date("Y.m.d", strtotime($rsp['createDay']))?></td>
									<td><button type="button" class="button button-primary btn-sm" onclick="pageRequest(<?=$rsp['idx']?>);"><i class="fa fa-wrench"></i></button> <button type="button" class="button button-danger btn-sm" onclick="pageDelete(<?=$rsp['idx']?>);"><i class="glyphicon glyphicon-trash"></i></button></td>
								</tr>
<? $j++; } ?>
<? if($recordcount==0){?>
								<tr>
									<td colspan="6">등록된 컨텐츠가 없습니다.</td>
								</tr>
<? } ?>

							</tbody>
						</table>
					<input type="hidden" name="pidx" value="">
					<input type="hidden" name="mode" value="">
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
var form = document.pageForm;

function pageRequest(a) {
	form.pidx.value = a;
	form.mode.value = "modify";
	form.method = "get";
	form.action = "pageInsert.php";
	form.submit();
}

function pageDelete(a) {
	if (confirm('삭제된 페이지는 복구할 수 없습니다. 해당 페이지를 삭제하시겠습니까?')==1) {
		form.pidx.value = a;
		form.action = "pageDelete.php";
		form.submit();
		return true;
	}
}
</script>
</html>