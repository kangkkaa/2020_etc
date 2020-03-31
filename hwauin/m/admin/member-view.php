<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$midx = $_GET['midx'];
$mode = $_GET['mode']; //admin or member
$npage = $_GET['npage'];
$search_text = $_GET['search_text'];

$sql_mem = "SELECT * FROM m_member WHERE idx=".$midx;
$rs_mem = mysql_fetch_array(mysql_query($sql_mem));

	if($rs_mem['mem_status']=="Y"){
		$status = "<span class='label label-primary'>정상</span>";
	}else if ($rs_mem['mem_status']=="N"){
		$status = "<span class='label label-danger'>탈퇴</span>";
	}
	if($rs_mem['mem_exitdate']==NULL OR $rs_mem['mem_exitdate']=="" OR $rs_mem['mem_exitdate']=="0000-00-00 00:00:00"){
		$exit = "";
	}else{
		$exit = date("Y.m.d", strtotime($rs_mem['mem_exitdate']));
	}
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
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
$page = "admin";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">관리회원 관리</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;회원 정보 보기</div>
						<div class="panel-body">
							<form name="viewForm" action="?" method="get" class="form-horizontal">
							<input type="hidden" name="midx" value="<?=$midx?>">
							<input type="hidden" name="mode" value="<?=$mode?>">
							<input type="hidden" name="processMode" value="">
							<input type="hidden" name="npage" value="<?=$npage?>">
							<input type="hidden" name="search_text" value="<?=$search_text?>">
								<div class="form-group">
									<label for="inputID" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;아이디</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$rs_mem['mem_id']?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="inputName" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;이름</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$rs_mem['mem_name']?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="inputMobile" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;연락처</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$rs_mem['mem_tel']?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;이메일</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$rs_mem['mem_email']?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;가입일</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=date("Y.m.d H:s:i", strtotime($rs_mem['join_date']))?></p>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;탈퇴일</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$exit?></p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;상태</label>
									<div class="col-five-sixth col-last nobottommargin">
										<p class="form-control-static"><?=$status?></p>									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer text-center">
							<a href="member.php?mode=<?=$mode?>&npage=<?=$npage?>&search_text=<?=$search_text?>"><span class="button button-green btn-sm"><i class="fa fa-bars left-icon"></i>목록</span></a>
							<button type="button" class="button button-primary btn-sm" onclick="goModify();"><i class="fa fa-wrench left-icon"></i>수정</button>
							<button type="button" class="button button-default btn-sm" onclick="goDelete();"><i class="glyphicon glyphicon-trash left-icon"></i>삭제</button>
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
<script language="JavaScript">
var form = document.viewForm;

function goModify() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.processMode.value = "modify";
	form.action = "member_add.php";
	form.submit();
	return true;
}

function goDelete() {
	if (confirm('삭제된 회원 정보는 복구할 수 없습니다. 이 회원 정보를 삭제하시겠습니까?')==1) {
		form.search_text.value = encodeURI(form.search_text.value);
		form.method = "post";
		form.processMode.value = "delete";
		form.action = "memberProcess.php";
		form.submit();
		return true;
	}
}
</script>
</html>