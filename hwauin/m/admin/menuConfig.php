<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$msql = "SELECT * FROM menuAdmin WHERE dept='1' ORDER BY sortNo";
$resultM = mysql_query($msql) or die(mysql_error());
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
$page = "menuConfig";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">사이트 메뉴 설정</h3>
				<div class="col-full nobottommargin topmargin"><a href="menuWrite.php"><span class="button button-success btn-sm notopmargin"><i class="fa fa-plus"></i>&nbsp;&nbsp;신규 메뉴 추가</span></a> <a href="menuSort.php"><span class="button button-danger btn-sm notopmargin"><i class="fa fa-sort"></i>&nbsp;&nbsp;메뉴 정렬 설정</span></a> <a href="menuConfig.php"><span class="button button-info btn-sm notopmargin"><i class="fa fa-sitemap"></i>&nbsp;&nbsp;전체 메뉴 목록</span></a></div>
				<div class="col-full">
					<form name="menuForm" action="" method="get">
						<table class="table">
							<thead>
								<tr class="text-primary info">
									<th>메뉴 이름</th>
									<th>관리 설명</th>
									<th>연결 컨텐츠</th>
									<th>연결 설정</th>
									<th>수정/삭제</th>
								</tr>
							</thead>
							<tbody class="text-center">
<? while($mrs=mysql_fetch_array($resultM)){ ?>
<? if($mrs['target']=="_self"){
	$target ="현재창으로 연결하기";
}else{
	$target = "새창으로 연결하기";
}
?>
								<tr>
									<td class="text-left"><b><i class="fa fa-plus text-danger"></i>&nbsp;&nbsp;<?=$mrs['menuName']?></b></td>
									<td><?=$mrs['menuMemo']?></td>
									<td></td>
									<td><?=$target?></td>
									<td>
										<button type="button" class="button button-primary btn-sm" onclick="menuModify(<?=$mrs['idx']?>);"><i class="fa fa-wrench"></i></button> 
										<button type="button" class="button button-danger btn-sm" onclick="menuDelete(<?=$mrs['idx']?>, 'main');"><i class="glyphicon glyphicon-trash"></i></button>
									</td>
								</tr>
<? if($mrs['subUseYN']=="Y"){?>
<? $ssql="SELECT * FROM menuAdmin WHERE dept='2' AND mainMenu='".$mrs['idx']."' ORDER BY sortNo";
$resultS = mysql_query($ssql) or die(mysql_error()); ?>
<? while($srs=mysql_fetch_array($resultS)){ 
	//연결 콘텐츠
	$sqllink="SELECT * FROM contentConfig WHERE idx='".$srs['contentIdx']."'";
	$rslink = mysql_fetch_array(mysql_query($sqllink));
	//연결 설정
	if($srs['target']=="_self"){
		$subtarget ="현재창으로 연결하기";
	}else{
		$subtarget = "새창으로 연결하기";
	}
?>
								<tr>
									<td class="text-left">&nbsp;&nbsp;&nbsp;<i class="fa fa-minus text-warning"></i>&nbsp;&nbsp;<?=$srs['menuName']?></td>
									<td><?=$srs['menuMemo']?></td>
									<td><?=$rslink['contentName']?></td>
									<td><?=$subtarget?></td>
									<td><button type="button" class="button button-primary btn-sm" onclick="menuModify(<?=$srs['idx']?>);"><i class="fa fa-wrench"></i></button> <button type="button" class="button button-danger btn-sm" onclick="menuDelete(<?=$srs['idx']?>, 'sub');"><i class="glyphicon glyphicon-trash"></i></button></td>
								</tr>
<? }//서브while ?>
<? }//if ?>
<? } ?>
							</tbody>
						</table>
					<input type="hidden" name="mode" value="">
					<input type="hidden" name="midx" value="">
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
var form = document.menuForm;

function menuModify(a) {
	form.midx.value = a;
	form.mode.value = "modify";
	form.action = "menuWrite.php";
	form.submit();
	return true;
}

function menuDelete(a, b) {
	var depthValue = b;
	var msgValue;

	if (depthValue == "main") {
		msgValue = "대메뉴 삭제시 연결된 소메뉴도 같이 삭제되며 삭제된 메뉴는 복구할 수 없습니다. 해당 대메뉴를 삭제하시겠습니까?";
	} else if (depthValue == "sub") {
		msgValue = "삭제된 메뉴는 복구할 수 없습니다. 해당 소메뉴를 삭제하시겠습니까?";
	}

	if (confirm(msgValue)==1) {
		form.midx.value = a;
		form.mode.value = "delete";
		form.method = "post";
		form.action = "menuProcess.php";
		form.submit();
		return true;
	}
}
</script>
</html>