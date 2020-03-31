<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}

$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
//구글 애널리틱스 설정 불러오기
$sqlgo="SELECT * FROM googleAnalytics WHERE no=1";
$rsgo = mysql_fetch_array(mysql_query($sqlgo));
//insert인지 modify인지 구별하기
$sqltotal = "SELECT COUNT(*) total_count FROM googleAnalytics ";
$rstotal = mysql_fetch_array(mysql_query($sqltotal));
$recordcount = $rstotal['total_count'];
unset($rstotal);
if($recordcount=="0"){
	$mode="insert";
}else{
	$mode="modify";
}
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
$page = "logConfig";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">구글 애널리틱스 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;구글 로그분석 프로그램 애널리틱스 설정</div>
						<div class="panel-body">
							<form name="gaForm" action="googleAnalyticsProcess.php" method="post">
							<input type="hidden" name="mode" value="<?=$mode?>">
							<input type="hidden" name="index" value="<?=$rsgo['no']?>">
								<div class="col-full halfbottom">
									<div class="form-group">
										<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;구글 애널리틱스 사용 설정</label>
										<div class="col-four-fifth col-last nobottommargin">
											<div class="checkbox">
												<input type="checkbox" value="Y" name="analyticsYN" <?if($rsgo['state']=="Y") {echo("checked");}?>> 사용 (활성화)
											</div>
											<p></p>
											<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;구글 애널리틱스 사용이 활성화되어 있을 경우에만 로그 및 통계가 형성됩니다.</p>
											<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;구글 애널리틱스 계정은 개별적으로 생성하셔야 하며 생성된 추적코드를 정확히 아래에 입력하셔야 합니다.</p>
											<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;설정 및 적용이 어려우시면 구글 검색을 참조하시거나 오리온네트웍스에 문의주십시요.</p>
										</div>
									</div>
								</div>
								<div class="col-two-third halfbottom">
									<label><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;구글 애널리틱스 추적코드</label>
								</div>
								<div class="col-full halfbottom">
									<textarea class="form-control" rows="15" name="ga_code"> <?=stripslashes($rsgo['content'])?> </textarea>
									<p class="text-danger"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;추적코드 중 &lt;script&gt;와 &lt;/script&gt;를 제외한 &lt;script&gt; ... &lt;/script&gt; 사이의 소스만 복사하여 넣으세요.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;script 라는 코드 또는 문자는 보안상의 이유로 오류가 발생하오니 반드시 유의하시기 바랍니다.</p>
								</div>
							</form>
							<div class="clear double-divider"></div>
							<div class="text-center">
								<a href="https://www.google.com/intl/ko/analytics/" target="_blank"><span class="button button-light"><i class="fa fa-google-plus-square left-icon"></i>구글 애널리틱스로 이동</span></a>
								<button type="button" class="button button-default" onclick="checkForm();"><i class="fa fa-upload left-icon"></i>설정 저장</button>
							</div>
						</div>
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
<script type="text/javascript">
var form = document.gaForm;

function checkForm() {
	if (confirm('추적코드 삽입시 유의사항에 따라 입력하셨습니까? 구글 애널리틱스 설정을 저장하시겠습니까?')==1) {
		form.submit();
		return true;
	}
}
</script>
</html>