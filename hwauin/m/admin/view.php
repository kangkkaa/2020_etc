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
if (!$rs_badmin) {
	Error('존재하지 않는 게시판입니다.', 'index.php');
}
$type_id = $rs_badmin['type_id'];
$sql_view = "SELECT * FROM boardTable WHERE b_id='".$b_idx."'";
$rs_view = mysql_fetch_array(mysql_query($sql_view));
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
					<span class="date-box">
						<h4><?=date('d', strtotime($rs_view['b_writeday']))?></h4>
						<span><?=date('m', strtotime($rs_view['b_writeday']))?>월</span>
					</span>
					<h3 class="date-title"><?=stripslashes($rs_view['b_subject'])?></h3>
					<ul class="list-inline text-muted">
						<li><i class="fa fa-user"></i><?=htmlspecialchars($rs_view['b_writerName'])?><span></span></li>
						<li><i class="fa fa-clock-o"></i> <?=date('Y.m.d H:i:s', strtotime($rs_view['b_writeday']))?><span></span></li>
						<li><i class="glyphicon glyphicon-hand-up"></i><?=$rs_view['b_hit']?><span></span></li>
						<li><i class="fa fa-comments"></i>&nbsp;<?=$rs_view['b_commentCnt']?></li>
					</ul>
				</div>
				<div class="col-full">
					<p>
<?if ($rs_view['file_names'] != "" && $type_id != 3) {//첨부파일?>
						첨부파일 : <a href="../board/upload_files/<?=$rs_view['file_names']?>" target="_blank"><?=$rs_view['file_realnames']?></a>
<?} else if ($rs_view['file_names'] != "" && $type_id == 3) { //갤러리?>
						<img src="../board/upload_files/<?=$rs_view['file_names']?>" border="0">
<? } ?>
					</p>
					<p><?=$rs_view['b_contents']?></p>

<? if($rs_badmin['type_id']==2){ ?>
<? if($rs_view['b_replyCnt']!=0 AND $rs_view['b_step']==0 AND $rMode!="rModify"){ //답글 있을 때 ?>
<? 
$sqlre = "SELECT * FROM boardTable WHERE b_parent='".$b_idx."' AND b_parent!=b_id";
$rsre = mysql_fetch_array(mysql_query($sqlre));
?>					<div class="alert alert-info topmargin">
						<h5>
							<i class="fa fa-reply"></i>&nbsp;&nbsp;<?=$rsre['b_subject']?>						
							<small class="pull-right">
								<ul class="list-inline text-muted">
									<li><i class="fa fa-user"></i> <?=$rsre['b_writerName']?><span></span></li>
									<li><i class="fa fa-clock-o"></i> <?=date('Y.m.d H:i:s', strtotime($rsre['b_writeday']))?></li>
								</ul>
							</small>
						</h5>
						<hr>
						<p><?=$rsre['b_contents']?></p>
						<hr>
						<p class="text-right">
							<button type="button" class="button button-green btn-sm" onclick="location.href='view.php?id=<?=$boardID?>&npage=<?=$npage?>&b_idx=<?=$b_idx?>&mode=<?=$mode?>&search_text=<?=$search_text?>&rMode=rModify';"><i class="fa fa-wrench left-icon"></i>답변 수정</button>
							<button type="button" class="button button-primary btn-sm" onclick="replyDeleteForm();"><i class="glyphicon glyphicon-trash left-icon"></i>답변 삭제</button>
						</p>
					</div>
					<form name="RedeleteForm" action="boardFormProcess.php" method="post">
					<input type="hidden" name="id" value="<?=$boardID?>">
					<input type="hidden" name="type_id" value="<?=$type_id?>">
					<input type="hidden" name="b_idx" value="<?=$b_idx?>">
					<input type="hidden" name="r_idx" value="">
					<input type="hidden" name="mode" value="">
					<input type="hidden" name="npage" value="<?=$npage?>">
					<input type="hidden" name="search_text" value="<?=$search_text?>">
					</form>
<script language="JavaScript">
function replyDeleteForm() {
	if (confirm('삭제된 답변은 복구할 수 없습니다. 현재 답변을 삭제하시겠습니까?')==1) {
		document.RedeleteForm.mode.value = "replyDelete";
		document.RedeleteForm.submit();
		return true;
	}
}
</script>
<? } else { ?>
<!-- -->
<!--답변등록/수정-->
<? $rMode = $_GET['rMode'];
if($rMode =="rModify"){
	$replyCheckForm = "replyModify";
	$sqlre = "SELECT * FROM boardTable WHERE b_parent='".$b_idx."' AND b_parent!=b_id";
	$rsre = mysql_fetch_array(mysql_query($sqlre));
	$writer = $rsre['b_writerName'];
}else{
	$writer = $_SESSION['mobile']['admName'];	
	$replyCheckForm = "replyInsert";
}
?>
				<div class="clear divider"></div>
					<div class="panel panel-inverse topmargin">
						<div class="panel-heading"><i class="fa fa-reply"></i>&nbsp;&nbsp;답변 등록/수정하기</div>
						<div class="panel-body">
							<form name="RewriteForm" action="boardFormProcess.php" method="post">
								<div class="col-two-third halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;답변 제목</label>
									<input type="text" name="r_title" class="form-control" value="<?=$rsre['b_subject']?>">
								</div>
								<div class="col-one-third col-last halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;답변 작성자</label>
									<input type="text" name="r_writer" class="form-control" value="<?=$writer?>">
								</div>
								<div class="col-full halfbottom">
									<textarea class="form-control" rows="5" name="r_content"><?=$rsre['b_contents']?></textarea>
								</div>
								<div class="col-full halfbottom text-right">
									<button type="button" class="button button-default btn-sm" onclick="replyCheckForm();"><i class="fa fa-bars left-icon"></i>답변등록</button>
								</div>
							<input type="hidden" name="id" value="<?=$boardID?>">
							<input type="hidden" name="r_idx" value="<?=$rsre['b_id']?>">
							<input type="hidden" name="type_id" value="<?=$type_id?>">
							<input type="hidden" name="b_idx" value="<?=$b_idx?>">
							<input type="hidden" name="mode" value="">
							<input type="hidden" name="npage" value="<?=$npage?>">
							<input type="hidden" name="search_text" value="<?=$search_text?>">
							</form>
						</div>
					</div>
<script language="JavaScript">
function replyCheckForm() {
	if (document.RewriteForm.r_title.value == "") {
		alert('제목을 입력하세요.');
		document.RewriteForm.r_title.focus();
		return false;
	} else if (document.RewriteForm.r_writer.value == "") {
		alert('작성자를 입력하세요.');
		document.RewriteForm.r_writer.focus();
		return false;
	} else if (document.RewriteForm.r_content.value == "") {
		alert('내용을 입력하세요.');
		document.RewriteForm.r_content.focus();
		return false;
	} else {
		if (confirm('작성하신 답변을 등록하시겠습니까?')==1) {
			document.RewriteForm.mode.value = "<?=$replyCheckForm?>";
			document.RewriteForm.submit();
			return true;
		}
	}
}
</script>
<? } } ?>
<!-- -->
<!-- 덧글 -->
<? if($rs_badmin['type_id']!=2){ 
if($rs_badmin['comment_yn']=="Y"){ //덧글기능 게시판일때
if($rs_view['b_commentCnt']>0){ //덧글이 있을 때
	$sqlcomment = "SELECT * FROM board_comment WHERE board_id='".$boardID."' AND b_id=".$b_idx." ORDER BY c_id"; 
?>

					<div class="dotted-divider"></div>
					<div class="alert alert-success topmargin">
						<p>
							<h6>등록된 댓글</h6>
<?	$resultcomment = mysql_query($sqlcomment) or die(mysql_error());
	$i=1;
	while($rscomment = mysql_fetch_array($resultcomment)) {?>	
							<hr>
							<i class="fa fa-comment"></i>&nbsp;&nbsp;<?=$rscomment['c_contents']?>							
							<small class="pull-right">
								<ul class="list-inline text-muted">
									<li><i class="fa fa-user"></i> <?=$rscomment['c_writerName']?><span></span></li>
									<li><i class="fa fa-clock-o"></i> <?=date('Y.m.d H:i:', strtotime($rscomment['c_regDate']))?><span></span></li>
									<li><i class="fa fa-trash-o"></i> <a href="javascript:commentDeleteForm(<?=$rscomment['c_id']?>);">댓글삭제</a></li>
								</ul>
							</small>
							<? } ?>
						</p>
					</div>
				</div>
<script language="JavaScript">
function commentDeleteForm(a) {
	if (confirm('삭제된 댓글은 복구할 수 없습니다. 현재 댓글을 삭제하시겠습니까?')==1) {
		document.viewForm.c_idx.value = a;
		document.viewForm.mode.value = "commentDelete";
		document.viewForm.submit();
		return true;
	}
}
</script>
<!---->
<? } } }?>
				<div class="clear divider"></div>
				<div class="text-center">
					<button type="button" class="button button-default btn-sm" onclick="location.href='board.php?npage=<?=$npage?>&id=<?=$boardID?>&search_text=<?=$search_text?>';"><i class="fa fa-bars left-icon"></i>목록</button>
					<button type="button" class="button button-green btn-sm" onclick="location.href='write.php?npage=<?=$npage?>&id=<?=$boardID?>&search_text=<?=$search_text?>&mode=modify&b_idx=<?=$b_idx?>';"><i class="fa fa-wrench left-icon"></i>수정</button>
					<button type="button" class="button button-primary btn-sm" onclick="deleteForm();"><i class="glyphicon glyphicon-trash left-icon"></i>삭제</button>
				</div>
				<form name="viewForm" action="boardFormProcess.php" method="post">
				<input type="hidden" name="nowFile" value="<?=$rs_view['file_names']?>">
				<input type="hidden" name="id" value="<?=$boardID?>">
				<input type="hidden" name="b_idx" value="<?=$b_idx?>">
				<input type="hidden" name="mode" value="">
				<input type="hidden" name="npage" value="<?=$npage?>">
				<input type="hidden" name="search_text" value="<?$search_text?>">
				<input type="hidden" name="c_idx" value="">
				</form>
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

function deleteForm() {
	if (confirm('삭제된 글과 첨부파일은 복구할 수 없습니다. 현재 게시글을 삭제하시겠습니까?')==1) {
		form.mode.value = "delete";
		form.submit();
		return true;
	}
}
</script>

</html>

