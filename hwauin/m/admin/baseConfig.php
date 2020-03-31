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
$page = "baseConfig";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">사이트 정보 관리</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;사이트 기본 정보 변경</div>
						<form name="writeForm" action="baseProcess.php" method="post" class="form-horizontal">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;사이트 타이틀</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_title" class="form-control" value="<?=htmlspecialchars($rs['siteTitle'])?>">
										<span class="help-block text-primary">타이틀은 인터넷 브라우저 상단에 표시됩니다. 사이트의 대표 제목, 이름의 성격으로 검색에도 중요한 부분을 차지합니다.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;사이트 설명</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_text" class="form-control" value="<?=$rs['siteMemo']?>" placeholder="예시) 오리온네트웍스에서 무료 홈페이지 솔루션을 제공합니다.">
										<span class="help-block text-primary">사이트에 대한 간략한 설명을 입력하실 수 있습니다. 사이트의 요약된 핵심 설명을 서술형으로 기술하십시요.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;주소</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_address" class="form-control" value="<?=$rs['siteAddress']?>" placeholder="예시) 서울시 구로구 구로3동 212-13">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;상세주소</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_address2" class="form-control" value="<?=$rs['siteAddress2']?>" placeholder="지번, 도로명 이하 나머지 주소를 입력 (예시) 벽산3차디지털밸리 906호">
										<span class="help-block text-primary">주소란에 지번, 도로명까지의 주소를 입력하시면 오시는길 약도에 자동으로 연동되어 보여집니다. 이하 주소는 상세주소에 입력해주세요.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;약도 메뉴 이름</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_mapname" class="form-control" value="<?=$rs['mapName']?>" placeholder="예시) 찾아오시는 길">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;약도 메뉴 설명</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_mapmemo" class="form-control" value="<?=$rs['mapMemo']?>" placeholder="예시) 약도와 주소 안내입니다.">
										<span class="help-block text-primary">약도 기능 페이지에 표시될 메뉴 이름과 설명입니다.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;연락처</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_tel" class="form-control" value="<?=$rs['siteTel']?>" placeholder="예시) 1688-3795">
										<span class="help-block text-primary">고객센터 또는 회사, 사업장 연락처를 입력하시면 홈페이지 내 전화걸기 기능과 자동으로 연동됩니다.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;운영시간</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_time" class="form-control" value="<?=$rs['siteCStime']?>" placeholder="예시) 평일 09:30~18:30 / 토, 일, 공휴일 휴무">
										<span class="help-block text-primary">고객센터, 회사, 사업장의 운영시간을 입력하세요.</span>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;카피라이터</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="s_copy" class="form-control" value="<?=$rs['siteCopyright']?>" placeholder="예시) Copyright © 2014. Orionnet All rights reserved.">
										<span class="help-block text-primary">홈페이지 하단에 표시된 저작권 관련 카피라이터를 입력해주세요.</span>
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<button type="submit" class="button button-default btn-sm"><i class="fa fa-check"></i>&nbsp;기본 정보 변경하기</button>
							</div>
						<input type="hidden" name="baseIdx" value="1">
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

