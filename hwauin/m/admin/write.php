<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$boardID = $_GET['id'];
$b_idx = $_GET['b_idx'];
if ($_GET['npage'] == "" || !$_GET['npage']) {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}
$mode = $_GET['mode'];
$search_text = $_GET['search_text'];

$sql_badmin = "SELECT * FROM boardAdmin WHERE board_id='".$boardID."'";
$result_badmin = mysql_query($sql_badmin) or die(mysql_error());
$rs_badmin = mysql_fetch_array($result_badmin);
$type_id = $rs_badmin['type_id'];


if($mode == "modify"){
	$sql_view = "SELECT * FROM boardTable WHERE b_id='".$b_idx."'";
	$rs_view = mysql_fetch_array(mysql_query($sql_view));
	$writer = $rs_view['b_writerName'];
}else if($mode=="insert"){
	$writer = $_SESSION['mobile']['admName'];
}

?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
$page = $boardID;
include "inc/left.php"; ?>	
		<div class="content-wrapper">
			<div class="container">
				<h3 class="title"><?=$rs_badmin['board_name']?></h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;글 등록/수정하기</div>
						<div class="panel-body">
							<form enctype="multipart/form-data" name="writeForm" action="boardFormProcess.php" method="post">
								<div class="col-two-third halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;제목</label>
									<input type="text" name="b_title" class="form-control" value="<?=$rs_view['b_subject']?>">
								</div>
								<div class="col-one-third col-last halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;이름</label>
									<input type="text" name="b_writer" class="form-control" value="<?=$writer?>" >
								</div>
<?if($type_id!="3"){ ?>
								<div class="col-full halfbottom">
									<div class="form-group">
										<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;공지글 설정</label>
										<div class="col-five-sixth col-last nobottommargin">
											<div class="checkbox">
												<input type="checkbox" value="Y" name="noticeYN" <?if($rs_view['b_noticeYN']=="Y"){echo"checked";}?>> 공지글 등록 (공지글은 각 게시판 상단에 항상 표시됩니다.)
											</div>
										</div>
									</div>
								</div>
<? } ?>
								<div class="col-full halfbottom">
									<textarea class="form-control" rows="15" name="b_content"><?=$rs_view['b_contents']?></textarea>
								</div>
<? if($rs_view['file_names']!=""){ ?>
								<div class="col-full nobottommargin">
									<label class="col-one-sixth text-default control-label"><i class="fa fa-check-square"></i>&nbsp;첨부된 파일</label>
									<div class="col-five-sixth col-last nobottommargin checkbox">
										<input type="checkbox" name="fileDeleteYN" value="Y"> 현재 첨부파일 삭제시 체크&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<font color="blue">현재 첨부파일 : </font><a href="../board/upload_files/<?=$rs_view['file_names']?>" target="_blank"><?=$rs_view['file_realnames']?></a><input type="hidden" value="<?=$rs_view['file_names']?>" name="nowFile">
									</div>
								</div>
<? } ?>
								<div class="col-full">
									<label class="col-one-sixth nobottommargin text-default control-label"><i class="fa fa-check-square"></i>&nbsp;첨부</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="file" class="form-control" name="userFile">
									</div>
								</div>
							<input type="hidden" name="id" value="<?=$boardID?>">
							<input type="hidden" name="type_id" value="<?=$type_id?>">
							<input type="hidden" name="b_idx" value="<?=$b_idx?>">
							<input type="hidden" name="mode" value="<?=$mode?>">
							<input type="hidden" name="npage" value="<?=$npage?>">
							<input type="hidden" name="search_text" value="<?=$search_text?>">
							</form>
							<div class="clear divider"></div>
							<div class="text-center">
								<a href="board.php?npage=<?=$npage?>&id=<?=$boardID?>&search_text=<?=$search_text?>"><span class="button button-light btn-sm"><i class="fa fa-times left-icon"></i>작성 취소</span></a>
								<button type="button" class="button button-default btn-sm" onclick="checkForm();"><i class="fa fa-check left-icon"></i>작성 완료</button>
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
var form = document.writeForm;

function checkForm() {
	if (form.b_title.value == "") {
		alert('제목을 입력하세요.');
		form.b_title.focus();
		return false;
	} else if (form.b_writer.value == "") {
		alert('작성자를 입력하세요.');
		form.b_writer.focus();
		return false;
	} else if (form.b_content.value == "") {
		alert('내용을 입력하세요.');
		form.b_content.focus();
		return false;
	} else {
		if (confirm('작성하신 글을 등록하시겠습니까?')==1) {
			form.submit();
			return true;
		}
	}
}
</script>

</html>

