<? include "../inc/link.php" ?>
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
$page = "main";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">관리 요약</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-bars"></i>&nbsp;&nbsp;홈페이지 설정</div>
						<table class="table table-striped table-hover">
							<thead>
								<tr class="text-primary info">
									<th width="10%">사용 여부</th>
									<th width="75%">홈페이지 기능 모듈</th>
									<th width="15%">관리</th>
								</tr>
							</thead>
							<tbody class="text-center">
								<tr>
									<td><span class="label label-sm label-primary"><i class="fa fa-check-circle-o"></i> 사용중</span></td>
									<td class="text-left">상담 / 문의 관리 기능</td>
									<td><a href="contactUs.php"><span class="label label-sm label-default"><i class="fa fa-cog"></i> 설정 관리</span></a></td>
								</tr>
								<tr>
									<td><span class="label label-sm label-primary"><i class="fa fa-check-circle-o"></i> 사용중</span></td>
									<td class="text-left">메인페이지 이미지 슬라이드 노출</td>
									<td><a href="mainPage.php"><span class="label label-sm label-default"><i class="fa fa-cog"></i> 설정 관리</span></a></td>
								</tr>
								<tr>
									<td><span class="label label-sm label-primary"><i class="fa fa-check-circle-o"></i> 사용중</span></td>
									<td class="text-left">메인페이지 하단 게시판 노출</td>
									<td><a href="mainPage.php"><span class="label label-sm label-default"><i class="fa fa-cog"></i> 설정 관리</span></a></td>
								</tr>
								<tr>
									<td><span class="label label-sm label-primary"><i class="fa fa-check-circle-o"></i> 사용중</span></td>
									<td class="text-left">질문답변 형태 게시판 생성</td>
									<td><a href="boardConfig.php"><span class="label label-sm label-default"><i class="fa fa-cog"></i> 설정 관리</span></a></td>
								</tr>
								<tr>
									<td><span class="label label-sm label-primary"><i class="fa fa-check-circle-o"></i> 사용중</span></td>
									<td class="text-left">갤러리 형태 게시판 생성</td>
									<td><a href="boardConfig.php"><span class="label label-sm label-default"><i class="fa fa-cog"></i> 설정 관리</span></a></td>
								</tr>
							</tbody>
						</table>
					</div>
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
</html>