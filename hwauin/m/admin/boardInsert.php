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
$page = "boardConfig";
include "inc/left.php"; ?>
<?
$mode = $_GET['mode'];
if($mode =="modify"){
	$idx = $_GET['bidx'];
	$sql = "SELECT * FROM boardAdmin WHERE idx=".$idx;
	$rsList = mysql_fetch_array(mysql_query($sql));
}
?>
		<div class="content-wrapper">
			<div class="container">
				<h3 class="title">게시판 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;게시판 생성 및 설정 변경</div>
						<form name="writeForm" action="boardProcess.php" method="post" class="form-horizontal" onsubmit="validForm(); return false;">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 고유 아이디</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="게시판의 고유아이디 영문, 숫자만 입력" name="boardID" value="<?if($mode=="modify"){echo($rsList['board_id']);}?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 이름</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="표시할 게시판의 이름을 입력" name="boardName" value="<?if($mode=="modify"){echo($rsList['board_name']);}?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 설명</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="표시할 게시판의 설명을 입력" name="boardMemo" value="<?if($mode=="modify"){echo($rsList['board_memo']);}?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 페이지 타이틀</label>
									<div class="col-four-fifth col-last nobottommargin">
										<input type="text" class="form-control" placeholder="표시할 게시판의 페이지 제목을 입력" name="siteTitle" value="<?if($mode=="modify"){echo($rsList['siteTitle']);}?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;페이지당 리스트 수</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="pull-left"><input type="text" class="form-control" name="pageSize" value="<?if($mode=="modify"){echo($rsList['page_size']);}?>" style="width: 50px; text-align: center; padding: 0px;" maxlength="3"></div>
										<div class="col-four-fifth col-last nobottommargin"><p class="form-control-static text-muted">&nbsp;&nbsp;1 ~ 100 사이의 숫자만 입력</p></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 종류</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="boardKind" value="1" <? if($mode == "modify"){if ($rsList['type_id'] == 1) { echo " checked"; }}?> >일반/자료실 게시판</label></div>
										<div class="radio rightmargin"><label><input type="radio" name="boardKind" value="2" <? if($mode == "modify"){if ($rsList['type_id'] == 2) { echo " checked"; }}?>>질문답변 게시판 (관리자만 답변가능)</label></div>
										<div class="radio"><label><input type="radio" name="boardKind" value="3" <? if($mode == "modify"){if ($rsList['type_id'] == 3) { echo " checked"; }}?>>갤러리 게시판</label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;글쓰기 권한</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="writeLevel" value="1" <? if($mode == "modify"){if ($rsList['write_level'] == 1) { echo " checked"; }}?>>관리자만</label></div>
										<div class="radio"><label><input type="radio" name="writeLevel" value="3" <? if($mode == "modify"){if ($rsList['write_level'] == 3) { echo " checked"; }}?>>모든 사용자</label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;댓글 기능</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="commentYN" value="N" <? if($mode == "modify"){if ($rsList['comment_yn'] == "N") { echo " checked"; }}?>>사용 안함</label></div>
										<div class="radio"><label><input type="radio" name="commentYN" value="Y" <? if($mode == "modify"){if ($rsList['comment_yn'] == "Y") { echo " checked"; }}?>>사용</label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;비밀글 기능</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="secretYN" value="N" <? if($mode == "modify"){if ($rsList['secretYN'] == "N") { echo " checked"; }}?>>사용 안함</label></div>
										<div class="radio"><label><input type="radio" name="secretYN" value="Y" <? if($mode == "modify"){if ($rsList['secretYN'] == "Y") { echo " checked"; }}?>>사용</label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-fifth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;게시판 활성화</label>
									<div class="col-four-fifth col-last nobottommargin">
										<div class="radio rightmargin"><label><input type="radio" name="statusYN" value="Y" <? if($mode == "modify"){if ($rsList['status'] == "Y") { echo " checked"; }}?>>활성</label></div>
										<div class="radio"><label><input type="radio" name="statusYN" value="N" <? if($mode == "modify"){if ($rsList['status'] == "N") { echo " checked"; }}?>>비활성 (비활성시 접근못함)</label></div>
									</div>
								</div>
							</div>
							<div class="panel-footer text-center">
								<a href="boardConfig.php"><span class="button button-light btn-sm"><i class="fa fa-times left-icon"></i>취소</span></a> <button type="submit" class="button button-default btn-sm"><i class="fa fa-check"></i>&nbsp;게시판 생성/설정 변경하기</button>
							</div>
						<input type="hidden" name="bidx" value="<?=$idx?>">
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
form = document.writeForm;

function validForm() {
	if (form.boardID.value == "") {
		alert('게시판 고유 아이디를 입력하세요.');
		form.boardID.focus();
		return false;
	} else if (form.boardName.value == "") {
		alert('게시판 이름을 입력하세요');
		form.boardName.focus();
		return false;
	} else if (form.pageSize.value == "" || form.pageSize.value > 100 || form.pageSize.value < 1) {
		alert('페이지당 리스트 수를 1~100 사이 숫자로 입력하세요');
		form.pageSize.focus();
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