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
$page = "logo";
include "inc/left.php"; ?>	
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">사이트 로고 관리</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;사이트 로고 변경</div>
						<form enctype="multipart/form-data" name="logoForm" action="logoProcess.php" method="post" class="form-horizontal">
							<div class="panel-body">
								<div class="form-group">
									<label for="selectCategory" class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;현재 등록된 로고</label>
									<div class="col-five-sixth col-last nobottommargin">
										<img src="../board/upload_files/<?=$rs['siteLogo']?>" border="0" width="150">
									</div>
								</div>
								<div class="form-group">
									<label for="inputContents" class="col-one-sixth control-label"></label>
									<div class="col-two-third">
										본 템플릿은 <font class="text-pink">가로 150픽셀, 세로 38픽셀에 최적화</font>되어 있습니다. 최적화 사이즈 이하의 이미지파일로 업로드해주세요.
									</div>
								</div>
								<div class="form-group">
									<label for="inputTitle" class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;새 로고 첨부</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="file" class="form-control" name="userFile">
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<button type="submit" class="button button-default btn-sm"><i class="fa fa-check"></i>&nbsp;로고 변경하기</button>
							</div>
						<input type="hidden" name="logoIdx" value="1">
						</form>
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