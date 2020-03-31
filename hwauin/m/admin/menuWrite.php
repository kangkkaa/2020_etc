<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$mode = $_GET['mode'];
if($mode==""){
	$mode="insert";
}
$midx = $_GET['midx'];
$sqlmenu = "SELECT * FROM menuAdmin WHERE dept=1 ORDER BY idx"; //대메뉴 연결 목록
$result_me = mysql_query($sqlmenu) or die(mysql_error());

if($mode=="modify"){
	$msql = "SELECT * FROM menuAdmin WHERE idx='".$midx."'"; //수정할 때 메뉴 정보
	$mrs = mysql_fetch_array(mysql_query($msql));
	//대메뉴? 소메뉴?
	if($mrs['dept']==1){
		$dept = "<span class='label label-danger'>대메뉴</span>";
	}else if($mrs['dept']==2){
		$dept = "<span class='label label-warning'>소메뉴</span>";
	}
}
$sql_con = "SELECT * FROM contentConfig ORDER BY contentKind ASC, idx"; //연결 컨텐츠 목록
$result_con = mysql_query($sql_con) or die(mysql_error());
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
<body id="admin-wrapper" class="stretched" onload="menuSelect();">
<?
$page = "menuConfig";
include "inc/left.php"; ?>		
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">사이트 메뉴 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;메뉴 추가 및 수정</div>
						<form name="newMenuForm" action="menuProcess.php" method="post" class="form-horizontal" onsubmit="validForm(); return false;">
							<div class="panel-body">
<? if($mode=="insert"){ ?>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;메뉴 분류</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" onclick="menuSelect();" name="menuKind" value="1" checked>대메뉴</label></div>
										<div class="radio"><label><input type="radio" onclick="menuSelect();" name="menuKind" value="2">소메뉴</label></div>
									</div>
								</div>
<? }else if($mode=="modify"){ ?>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;메뉴 분류</label>
									<div class="col-four-fifth col-last nobottommargin">
										<p class="form-control-static"><?=$dept?></p>
									</div>
								</div>
<? } ?>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;대메뉴 연결</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="mainMenu" class="form-control">
											<option value="0" selected>연결 대메뉴 없음</option>
<? while($rsme=mysql_fetch_array($result_me)){?>
											<option value="<?=$rsme['idx']?>" <?if ($mrs['mainMenu']==$rsme['idx']) {echo ("selected");}?>><?=$rsme['menuName']?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;메뉴 이름</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="표시할 메뉴의 이름을 입력" name="menuName" value="<?=$mrs['menuName']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;관리 설명</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="표시할 메뉴의 설명을 입력" name="menuMemo" value="<?=$mrs['menuMemo']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;컨텐츠 연결</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="contentValue" class="form-control">
											<option value="0" selected>연결 컨텐츠 없음</option>
<? while($rs_con = mysql_fetch_array($result_con)){ ?>
											<option value="<?=$rs_con['idx']?>" <?if ($rs_con['idx']==$mrs['contentIdx']) {echo ("selected");}?>><?=$rs_con['contentName']?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;연결 설정</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="linkConf" value="_self" checked>현재창으로 연결</label></div>
										<div class="radio"><label><input type="radio" name="linkConf" value="_blank">새창으로 연결</label></div>
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<a href="menuConfig.php"><span class="button button-light btn-sm"><i class="fa fa-times left-icon"></i>취소</span></a> <button type="submit" class="button button-default btn-sm"><i class="fa fa-check"></i>&nbsp;메뉴 생성/설정 변경하기</button>
							</div>
						<input type="hidden" name="midx" value="<?=$midx?>">
						<input type="hidden" name="mode" value="<?=$mode?>">
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
form = document.newMenuForm;

function menuSelect() {
	if (form.menuKind[0].checked == true) {
		form.mainMenu.disabled = true;
	} else {
		form.mainMenu.disabled = false;
	}
}

function validForm() {
	if (form.menuName.value == "") {
		alert('메뉴 이름을 입력하세요.');
		form.menuName.focus();
		return false;
	} else {
		if (confirm('생성 및 설정을 완료하시겠습니까?')==1) {
			form.submit();
			return true;
		}
	}
}
</script>

</html>

