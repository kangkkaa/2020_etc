<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', '../index.php');
}
mysql_query('set names utf8');
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
$page = $boardID;
include "inc/left.php"; ?>
<? 
$page_block = 10;
$page_size = $rs_badmin['page_size'];

if ($_GET['npage'] == "") {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}

$sql = "SELECT COUNT(*) total_count FROM boardTable WHERE board_id='".$boardID."' AND b_parent=b_id AND b_noticeYN='N'";
$sqllist = "SELECT * FROM boardTable WHERE board_id='".$boardID."' AND b_parent=b_id AND b_noticeYN='N'";

if ($_GET['search_text'] != "") {
	$sql = $sql." AND (b_subject LIKE '%".urldecode($_GET['search_text'])."%' OR b_contents LIKE '%".urldecode($_GET['search_text'])."%' OR b_writerName LIKE '%".urldecode($_GET['search_text'])."%')";
	$sqllist = $sqllist." AND (b_subject LIKE '%".urldecode($_GET['search_text'])."%' OR b_contents LIKE '%".urldecode($_GET['search_text'])."%' OR b_writerName LIKE '%".urldecode($_GET['search_text'])."%')";
}

$sqllist = $sqllist." ORDER BY b_writeday DESC, b_parent DESC, b_step LIMIT ".(($npage-1) * $page_size).", ".$page_size;
$result = mysql_query($sqllist) or die(mysql_error());

$rs = mysql_fetch_array(mysql_query($sql));
$recordcount = $rs['total_count'];
unset($rs);

?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title"><?=$rs_badmin['board_name']?></h3>
				<div class="col-full topmargin">
					<form name="searchForm" id="searchForm" action="?" method="get">
					<input type="hidden" name="id" value="<?=$boardID?>">
					<input type="hidden" name="npage" value="<?=$npage?>">
					<input type="hidden" name="b_idx" value="">
					<input type="hidden" name="mode" value="<?=$mode?>">
						<div class="form-inline pull-left">
							<input type="text" name="search_text" placeholder="제목, 내용, 작성자 통합검색" value="<?=urldecode($_GET['search_text'])?>" class="form-control" style="width: 200px;">
							<button type="button" onclick="goSearch();" class="button button-light btn-sm"><i class="fa fa-search"></i>&nbsp;검색</button>
						</div>
					</form>
					<table class="table table-striped">
						<thead>
							<tr class="text-primary info">
								<th width="6%">No</th>
								<th width="54%">제목</th>
<?if($rs_badmin['type_id']==2){?>
								<th width="6%">답변여부</th>
<? } ?>
								<th width="10%">작성자</th>
								<th width="16%">작성일</th>
								<th width="8%">조회수</th>
							</tr>
						</thead>
						<tbody class="text-center">
<?
$no_sqllist = "SELECT * FROM boardTable WHERE board_id='".$boardID."' AND b_parent=b_id AND b_noticeYN='Y'";
$result_no = mysql_query($no_sqllist) or die(mysql_error());
while ($rs_no = mysql_fetch_array($result_no)) {
	$witerName = mb_strimwidth($rs_no['b_writerName'], 0,25, " ...", "UTF-8");
	$writeday = date('Y.m.d H:s:i', strtotime($rs_no['b_writeday']));
		if ($rs_no['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font color='red'>[".$rs_no['b_commentCnt']."]</font>";
	}
?>
							<tr class="warning">
								<td><span class="label label-sm label-warning"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;공지</span></td>
								<td class="text-left"><a href="javascript:goView(<?=$rs_no['b_id']?>);"><?=$rs_no['b_subject']." ".$comment_cnt?></a></td>
<?if($rs_badmin['type_id']==2){?>
								<td></td>
<? } ?>								
								<td><?=$witerName?></td>
								<td><?=$writeday?></td>
								<td><?=$rs_no['b_hit']?></td>
							</tr>
<? }
$j = 1;
while ($rs = mysql_fetch_array($result)) {
	if ($rs['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font color='red'>[".$rs['b_commentCnt']."]</font>";
	}

	if ($comment_cnt == "") {
		$b_subject = mb_strimwidth($rs['b_subject'], 0, 60, " ...", "UTF-8");
	} else {
		$b_subject = mb_strimwidth($rs['b_subject'], 0, 58, " ...", "UTF-8");
	}

	if ($rs['b_secretYN'] == "Y") {
		$secret = "Y";
		$secretIcon ="<i class='fa fa-lock'></i>&nbsp;&nbsp;";
	} else {
		$secretIcon ="";
		$secret = "N";
	}
		$today = date("Y.m.d H:s:i", time(0));
		$writeday=date('Y.m.d H:s:i', strtotime($rs['b_writeday']));
	if($today==$writeday){
		$b_new="<span style='background: #EEA32C; color: #fff; font-size: 11px; padding: 2px;box-shadow: 2px 2px 0px #ccc;'>&nbsp;<i class='fa fa-exclamation'></i>&nbsp;새글</span>";
	}else{
		$b_new="";
	}
		$b_title = mb_strimwidth($rs['b_title'], 0, 80, " ...", "UTF-8");
		$b_title = $b_title." ".$comment_cnt.$b_secret_icon.$b_new;
		$witerName = mb_strimwidth($rs['b_writerName'], 0,25, " ...", "UTF-8");

	if ($rs['b_replyYN']=="Y"){
		$reply="<span class='label label-sm label-success'><i class='fa fa-reply'></i>&nbsp;&nbsp;답변</span>";
	}else if($rs['b_replyYN']=="N"){
		$reply="<span class='label label-sm label-danger'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;대기</span>";
	}

	$b_subject = $secretIcon.$b_subject.$comment_cnt;
?>
							<tr>
								<td><?=$recordcount-($j+(($npage-1)*$page_size))+1?></td>
								<td class="text-left"><a href="javascript:goView(<?=$rs['b_id']?>);"><?=$b_subject?></a></td>
<?if($rs_badmin['type_id']==2){?>
								<td><?=$reply?></td>
<? } ?>
								<td><?=htmlspecialchars($witerName)?></td>
								<td><?=$writeday?></td>
								<td><?=$rs['b_hit']?></td>
							</tr>
<? $j++;} ?>
<? if($recordcount==0){ ?>
<? if($rs_badmin['type_id']==3){
	$no = 5;
}else{
	$no = 6;
}
?>
							<tr>
								<td colspan="<?=$no?>">등록된 게시글이 없습니다.</td>
							</tr>
<? } ?>
						</tbody>
					</table>
						</ul>
					</div>
					<div class="col-half">
<? include "inc/page_block.php";?>
					</div>
					<div class="col-half col-last text-right"><a href="javascript:goWrite();"><span class="button button-default btn-sm notopmargin"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;글쓰기</span></a></div>
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
<script type="text/javascript" language="javascript" src="js/jquery.prettyPhoto.js"></script>
<script language="JavaScript">
$(document).ready(function(){
	$("area[rel^='prettyPhoto']").prettyPhoto();
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
	$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
});

var form = document.searchForm;

function goView(a) {
	form.search_text.value = encodeURI(form.search_text.value);
	form.b_idx.value = a;
	form.mode.value = "view";
	form.action = "view.php";
	form.submit();
}

function goWrite() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.mode.value = "insert";
	form.action = "write.php";
	form.submit();
}

function goSearch() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.submit();
}
</script>
</html>

