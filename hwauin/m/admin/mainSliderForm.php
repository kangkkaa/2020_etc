<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$mode = $_GET['mode'];
if($mode ==""){
	$mode ="insert";
}
$idx = $_GET['idx'];

$sql_con = "SELECT * FROM contentConfig ORDER BY contentKind ASC";
$result_con = mysql_query($sql_con) or die(mysql_error());

$Ssql = "SELECT * FROM imageSlider WHERE idx='".$idx."'";
$rs_s= mysql_fetch_array(mysql_query($Ssql));
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
<? include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">메인이미지 슬라이드 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;메인이미지 슬라이드 설정 추가/변경</div>
						<form enctype="multipart/form-data" name="imageForm" action="sliderProcess.php" method="post">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-full control-label text-default">각 이미지 슬라이드마다 동일한 픽셀 사이즈의 이미지를 사용하시기 바랍니다.</label>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label halfbottom"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;제목</label>
									<div class="col-five-sixth col-last halfbottom">
										<input type="text" name="main_text" class="form-control" value="<?=htmlspecialchars($rs_s['mainImage_Title'])?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label halfbottom"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;설명글</label>
									<div class="col-five-sixth col-last halfbottom">
										<input type="text" name="main_subtext" class="form-control" value="<?=htmlspecialchars($rs_s['mainText'])?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label halfbottom"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;정렬순서</label>
									<div class="col-five-sixth col-last halfbottom">
										<div class="pull-left"><input type="text" name="sortNum" class="form-control" value="<?=$rs_s['sortNo']?>" maxlength="5" style="width: 30px; text-align: center;"></div>
										<div class="col-five-sixth col-last nobottommargin"><p class="form-control-static text-muted">&nbsp;&nbsp;1이상의 숫자만 입력, 낮은 숫자의 이미지가 먼저 슬라이드됩니다.</p></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label halfbottom"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;이미지 컨텐츠 연결</label>
									<div class="col-five-sixth col-last halfbottom">
										<select name="contentValue" class="form-control">
											<option value="0" <?if ($rs_s['mainImage_link']==0) {echo ("selected");}?>>연결 컨텐츠 없음</option>
<? while($rs_con = mysql_fetch_array($result_con)){ ?>
											<option value="<?=$rs_con['idx']?>" <?if ($rs_con['idx']==$rs_s['mainImage_link']) {echo ("selected");}?>><?=htmlspecialchars($rs_con['contentName'])?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;메인이미지 첨부</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="file" class="form-control" name="userFile">
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<button type="button" class="button button-warning btn-sm" onclick="location.href='mainSlider.php';"><i class="fa fa-check"></i>&nbsp;취소</button> 
								<button type="button" class="button button-default btn-sm" onclick="checkForm(); return false;"><i class="fa fa-check"></i>&nbsp;메인이미지 슬라이드 추가 / 변경하기</button>
							</div>
						<input type="hidden" name="mode" value="<?=$mode?>">
						<input type="hidden" name="idx" value="<?=$idx?>">
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
<script type="text/javascript">
function checkForm() {
	var form = document.imageForm;

	if (form.main_text.value == "") {
		alert('이미지 슬라이드의 제목을 입력해주세요.');
		form.main_text.focus();
	} else if (form.main_subtext.value == "") {
		alert('이미지 슬라이드의 설명을 입력해주세요.');
		form.main_subtext.focus();
	} else if (form.sortNum.value == "") {
		alert('슬라이드 정렬순서를 숫자로 입력해주세요.');
		form.sortNum.focus();
	} else {
		form.submit();
		return true;
	}
}
</script>
</html>