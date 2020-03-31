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
$page = "mainPage";
include "inc/left.php"; ?>
<? $sql_main = "SELECT * FROM mainConfig WHERE idx=1";
   $rs_min = mysql_fetch_array(mysql_query($sql_main));

   $sql_con = "SELECT * FROM contentConfig ORDER BY contentKind ASC";
   $result_con = mysql_query($sql_con) or die(mysql_error());

   $sql_conb = "SELECT * FROM contentConfig WHERE contentKind ='B'";
   $result_conb = mysql_query($sql_conb) or die(mysql_error());
?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">메인 페이지 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;메인 페이지 설정 변경</div>
						<form name="writeForm" action="mainProcess.php" method="post" class="form-horizontal">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;메인이미지 슬라이드 사용</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="checkbox">
											<input type="checkbox" value="Y" name="imageYN" <?if($rs_min['mainimageYN']=="Y"){echo("checked");}?>> 사용
										</div>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 1 사용 여부</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="checkbox">
											<input type="checkbox" name="service1_YN" value="Y" <?if($rs_min['service1_YN']=="Y"){echo("checked");}?>> 사용
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 제목 1</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="service_text1" class="form-control" value="<?=$rs_min['serviceTitle1']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 설명글 1</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="service_subtext1" class="form-control" value="<?=$rs_min['serviceText1']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 1 컨텐츠 연결</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="contentValue1" class="form-control">
											<option value="0" <?if ($rs_min['service1_link']==0) {echo ("selected");}?>>연결 컨텐츠 없음</option>
<?
while($rs_con = mysql_fetch_array($result_con)){ ?>
											<option value="<?=$rs_con['idx']?>" <?if ($rs_con['idx']==$rs_min['service1_link']) {echo ("selected");}?>><?=$rs_con['contentName']?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 2 사용 여부</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="checkbox">
											<input type="checkbox" name="service2_YN" value="Y" <?if($rs_min['service2_YN']=="Y"){echo("checked");}?>> 사용
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 제목 2</label>
									<div class="col-four-fifth col-last nobottommargin">
										<font color="#336699"><input type="text" name="service_text2" class="form-control" value="<?=$rs_min['serviceTitle2']?>"></font>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 설명글 2</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="service_subtext2" class="form-control" value="<?=$rs_min['serviceText1']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 2 컨텐츠 연결</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="contentValue2" class="form-control">
											<option value="0" <?if ($rs_min['service2_link']==0) {echo ("selected");}?>>연결 컨텐츠 없음</option>
<? 
$result_con = mysql_query($sql_con) or die(mysql_error());
while($rs_con = mysql_fetch_array($result_con)){ ?>
											<option value="<?=$rs_con['idx']?>" <?if ($rs_con['idx']==$rs_min['service2_link']) {echo ("selected");}?>><?=$rs_con['contentName']?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 3 사용 여부</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="checkbox">
											<input type="checkbox" name="service3_YN" value="Y" <?if($rs_min['service3_YN']=="Y"){echo("checked");}?>> 사용
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 제목 3</label>
									<div class="col-four-fifth col-last nobottommargin">
										<font color="#336699"><input type="text" name="service_text3" class="form-control" value="<?=$rs_min['serviceTitle3']?>"></font>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 설명글 3</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="service_subtext3" class="form-control" value="<?=$rs_min['serviceText3']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;서비스 3 컨텐츠 연결</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="contentValue3" class="form-control">
											<option value="0" <?if ($rs_min['service3_link']==0) {echo ("selected");}?>>연결 컨텐츠 없음</option>
<? 
$result_con = mysql_query($sql_con) or die(mysql_error());
while($rs_con = mysql_fetch_array($result_con)){ ?>
											<option value="<?=$rs_con['idx']?>" <?if ($rs_con['idx']==$rs_min['service3_link']) {echo ("selected");}?>><?=$rs_con['contentName']?></option>
<? } ?>
										</select>
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;사이트 타이틀</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="siteTitle" class="form-control" value="<?=$rs_min['siteTitle']?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;사이트 태그</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="siteTag" class="form-control" value="<?=$rs_min['siteTag']?>" placeholder="사이트의 주요 키워드 및 태그를 입력하실 수 있습니다. 키워드 구분은 콤마(,)로 구분하십시요.">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;사이트 설명</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" name="siteDescription" class="form-control" value="<?=$rs_min['siteDescription']?>">
									</div>
								</div>
								<div class="divider"></div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 표시 여부</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="checkbox">
											<input type="checkbox" name="board_useYN" value="Y" <?if($rs_min['board_useYN']=="Y"){echo("checked");}?>> 사용
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;표시 게시판 컨텐츠</label>
									<div class="col-four-fifth col-last nobottommargin">
										<select name="b_contentValue" class="form-control">
											<option value="0" <?if ($rs_min['b_contentValue']==0) {echo ("selected");}?>>최근 게시물</option>
<? while($rs_conb = mysql_fetch_array($result_conb)){ ?>
											<option value="<?=$rs_conb['idx']?>" <?if ($rs_conb['idx']==$rs_min['b_contentValue']) {echo ("selected");}?>><?=$rs_conb['contentName']?></option>
<? } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<button type="submit" class="button button-default btn-sm"><i class="fa fa-check"></i>&nbsp;메인페이지 디자인 설정 변경하기</button>
							</div>
						<input type="hidden" name="mainIdx" value="1">
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