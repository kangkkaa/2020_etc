<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
//신디케이션 설정 불러오기
$sqlsy = "SELECT * FROM syndication WHERE idx = 1";
$rssy = mysql_fetch_array(mysql_query($sqlsy));
$siteUrl = $rssy['url'];
$time = $rssy['createDay'];
//insert / modify 
$sqltotal = "SELECT COUNT(*) total_count FROM syndication ";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<script type="text/javascript" language="javascript" src="js/common.js"></script>
</head>
<body id="admin-wrapper" class="stretched">
<?
$page = "syndication";
include "inc/left.php"; ?>
<div class="content-wrapper">
			<div class="container">
				<h3 class="title">신디케이션API</h3>
				<div class="col-full topmargin">
				<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;신디케이션API 설정</div>
						<div class="panel-body">
						<form name="gaForm" action="syndicationProcess.php" method="post">
						<input type="hidden" name="mode" value="<?=$mode?>">
						<div class="col-full halfbottom">
							<div class="form-group">
								<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;신디케이션 API 사용 설정</label>
								<div class="col-four-fifth col-last nobottommargin">
									<div class="checkbox">
										<input type="checkbox" value="Y" name="status" <?if($rssy['status']=="Y") {echo("checked");}?>> 사용 (활성화)
									</div>
									<p></p>
									<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;신디케이션 API 사용이 활성화되어 있을 경우에만 연동이 가능합니다.</p>
									<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;신디케이션을 처음 활성화 시키실 경우, 설정 저장 후 게시판 Ping 보내기를 반드시 한 번 클릭하셔야 합니다. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;그 다음 Naver Syndication 연결확인을 통해 상태가 standby일 경우 고객센터에 연동해달라고 요청하는 메일을 보내시면 됩니다.</p>
									<p><i class="fa fa-exclamation-circle text-danger"></i>&nbsp;&nbsp;설정 및 적용이 어려우시면 신디케이션 가이드를 참조하시거나 오리온네트웍스로 문의주십시요.</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;연동키</label>
								<div class="col-five-sixth col-last nobottommargin" >
									<p><input name="siteUrl" class="form-control" style=" display: inline; width:50%;" type="text" value="<?=$siteUrl?>"></p>
									<p></p>
								</div>
						</div>
						<div class="col-two-third halfbottom">
							<label><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;신디케이션 노출 제외 게시판</label>
						</div>
						<div class="col-full" style="margin-bottom:0;" >
							<textarea class="form-control" rows="15" name="exceptTable"> <?=stripslashes($rssy['exceptTable'])?> </textarea>
							<p class="text-danger"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;네이버에 노출을 제외하고 싶으신 게시판의 아이디를 적어주시면 됩니다.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex) consult, gallery, free 와 같은 형식으로 적어주세요. 그렇지 않을경우 오류가 납니다.</p>
						</form>
						<div class="text-right" style="margin:20px;">
							<button type="button" class="button button-default" onclick="checkForm();"><i class="fa fa-upload left-icon"></i>설정 저장</button>
						</div>
							<!-- <label><i class="fa fa-check-square text-default" style="margin:20px 0;"></i>&nbsp;&nbsp;네이버 신디케이션 핑(Naver Syndication PING) 확인</label>
						</div>
						<table class="table table-striped table-hover nobottommargin">
							<tbody class="text-center">

								<tr>
									<td><a href="http://developer.naver.com/wiki/pages/SyndicationAPI">신디케이션 가이드</a></td>
									<td><a href="http://syndication.openapi.naver.com/status/?site=<?=$siteUrl?>">Naver Syndication 연결확인</a></td>
								</tr>
								<tr>
									<td><a href="<?="http://".$siteUrl?>/syndi/syndi_echo.php?id=tag:<?=$siteUrl.','.$time?>:site&type=site">사이트 
									<td><a href="<?="http://".$siteUrl?>/syndi/syndi_echo.php?id=tag:<?=$siteUrl.','.$time?>:site&type=channel">채널 목록</a></td>
								</tr>
								<tr>
									<td><a href="<?="http://".$siteUrl?>/syndi/syndi_echo.php?id=tag:<?=$siteUrl.','.$time?>:site&type=article"">사이트의 모든 문서 목록</a></td>
									<td><a href="<?="http://".$siteUrl?>/syndi/syndi_echo.php?id=tag:<?=$siteUrl.','.$time?>:site&type=deleted">사이트의 모든 삭제문서 목록</a></td>
								</tr>
								<tr>
									<td><a href="boardPing.php">게시판 Ping 보내기</a></td>
									<td><a href="https://help.naver.com/support/contents/contents.nhn?serviceNo=606&categoryNo=2017">Naver 고객센터</a></td>
								</tr>
							</tbody>
						</table> -->
						<p style="margin:20px;"></p>
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
<script type="text/javascript">
var form = document.gaForm;

function checkForm() {
	if (!urlcheck(form.siteUrl.value)) {
		
		form.siteUrl.focus();

	}
	else if (confirm('노출 제외 게시판 삽입시 유의사항에 따라 입력하셨습니까? 신디케이션 API 설정을 저장하시겠습니까?')==1) {
		form.submit();
		return true;
	}
}
</script>
<script type="text/javascript" language="javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="dist/js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
</body>
</html>