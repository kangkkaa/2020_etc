<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$Ssql = "SELECT * FROM imageSlider ORDER BY sortNo";
$result_s= mysql_query($Ssql) or die(mysql_error());

$sql_c = "SELECT COUNT(*) total_count FROM imageSlider";
$rs_c = mysql_fetch_array(mysql_query($sql_c));
$recordcount = $rs_c['total_count'];
unset($rs_c);
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
$page = "mainSlider";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">메인이미지 슬라이드 설정</h3>
				<div class="col-full nobottommargin topmargin"><a href="mainSliderForm.php" class="button button-default btn-sm" style="color:#ffffff;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;메인이미지 슬라이드 추가하기</a></div>
				<div class="col-full">
					<form name="imageForm" method="get" action="">
						<table class="table table-striped">
							<thead>
								<tr class="text-primary info">
									<th width="8%">순서</th>
									<th width="20%">이미지</th>
									<th width="10%">컨텐츠 연결</th>
									<th width="20%">제목</th>
									<th width="27%">설명글</th>
									<th width="15%">수정/삭제</th>
								</tr>
							</thead>
							<tbody class="text-center">
<? 
$j=1;
while($rs_s = mysql_fetch_array($result_s)){?>
								<tr>
									<td><?=$j?></td>
									<td><a href="../board/upload_files/<?=$rs_s['file_name']?>" target="_blank"><img src="../board/upload_files/<?=$rs_s['file_name']?>" class="img-responsive img-thumbnail" width="100"></a></td>
									<td><?=htmlspecialchars($rs_s['mainImage_link'])?></td>
									<td><?=htmlspecialchars($rs_s['mainImage_Title'])?></td>
									<td><?=htmlspecialchars($rs_s['mainText'])?></td>
									<td><button type="button" class="button button-primary btn-sm" onclick="modifyForm(<?=$rs_s['idx']?>);"><i class="fa fa-wrench"></i></button> <button type="button" class="button button-danger btn-sm" onclick="deleteForm(<?=$rs_s['idx']?>); return false;"><i class="fa fa-trash-o"></i></button></td>
								</tr>
<? $j++; } ?>
<? if($recordcount==0){?>
								<tr>
								<td colspan="6">등록된 이미지 슬라이드가 없습니다.</td>
								</tr>
<? } ?>
							</tbody>
						</table>
					<input type="hidden" name="mode" value="">
					<input type="hidden" name="idx" value="">
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
var form = document.imageForm;

function modifyForm(a) {
	form.mode.value = "modify";
	form.idx.value = a;
	form.action = "mainSliderForm.php";
	form.submit();
}

function deleteForm(a) {
	if (confirm('삭제된 이미지 슬라이드는 복구할 수 없습니다. 해당 슬라이드를 삭제하시겠습니까?')==1) {
		form.mode.value = "delete";
		form.idx.value = a;
		form.method = "post";
		form.action = "sliderProcess.php";
		form.submit();
		return true;
	}
}
</script>
</html>