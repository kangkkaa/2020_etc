<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$sqlUs = "SELECT * FROM boardAdmin WHERE board_id = 'contactusOrionnet'";
$rsus = mysql_fetch_array(mysql_query($sqlUs));
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
$page = "contactusOrionnet";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">상담/문의 관리</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;상담/문의 관리 설정</div>
						<div class="panel-body">
							<form name="modifyForm" action="contactUsProcess.php" method="post">
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;기능 사용 여부</label>
									<div class="checkbox">
										<input type="checkbox" value="Y" name="menu_YN" <?if($rsus['status']=="Y"){echo("checked");}?>> 사용
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;표시할 메뉴 이름</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="menu_title" class="form-control" value="<?=htmlspecialchars($rsus['board_name'])?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;표시할 메뉴 설명</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="menu_memo" class="form-control" value="<?=htmlspecialchars($rsus['board_memo'])?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label nobottommargin"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;페이지 타이틀</label>
									<div class="col-five-sixth col-last nobottommargin">
										<input type="text" name="site_title" class="form-control" value="<?=htmlspecialchars($rsus['siteTitle'])?>">
									</div>
								</div>
								<div class="form-inline pull-right">
									<button type="submit" class="button button-default btn-sm"><i class="fa fa-wrench"></i>&nbsp;설정 저장</button>
								</div>
							<input type="hidden" name="mode" value="menuConfig">
							</form>
						</div>
					</div>
				</div>
<? 
$page_block = 10;
$page_size = $rsus['page_size'];

if ($_GET['npage'] == "") {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}

$sql = "SELECT COUNT(*) total_count FROM boardTable WHERE board_id='contactusOrionnet' AND b_parent=b_id";
$sqllist = "SELECT * FROM boardTable WHERE board_id='contactusOrionnet' AND b_parent=b_id";

if ($_GET['search_text'] != "") {
	$sql = $sql." AND (b_subject LIKE '%".urldecode($_GET['search_text'])."%' OR b_contents LIKE '%".urldecode($_GET['search_text'])."%' OR b_writerName LIKE '%".urldecode($_GET['search_text'])."%')";
	$sqllist = $sqllist." AND (b_subject LIKE '%".urldecode($_GET['search_text'])."%' OR b_contents LIKE '%".urldecode($_GET['search_text'])."%' OR b_writerName LIKE '%".urldecode($_GET['search_text'])."%')";
}

$sqllist = $sqllist." ORDER BY b_writeday DESC, b_parent DESC, b_step LIMIT ".(($npage-1) * $page_size).", ".$page_size;
$result = mysql_query($sqllist) or die(mysql_error());

$rs = mysql_fetch_array(mysql_query($sql));
$recordcount = $rs['total_count'];
unset($rs);
?>				<div class="clear dotted-divider"></div>
				<div class="col-full">
					<form name="searchForm" action="?" method="get">
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
								<th width="60%">문의 제목</th>
								<th width="10%">작성자</th>
								<th width="16%">작성일</th>
								<th width="8%">확인여부</th>
							</tr>
						</thead>
						<tbody class="text-center">
<? 
$j = 1;
while ($rs = mysql_fetch_array($result)) {
	$witerName = mb_strimwidth($rs['b_writerName'], 0,25, " ...", "UTF-8");

	if ($rs['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font style='font-size:8pt;color:#FF6699;'>[".$rs['b_commentCnt']."]</font>";
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
		$b_subject = $secretIcon.$b_subject;
	if ($rs['b_replyYN']=="Y"){
		$reply="<span class='label label-sm label-success'><i class='fa fa-reply'></i>&nbsp;&nbsp;답변</span>";
	}else if($rs['b_replyYN']=="N"){
		$reply="<span class='label label-sm label-danger'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;대기</span>";
	}


	if($rs['b_hit']==0){
		$status = "<span class='text-danger strong'>접수</span>";
	}else{
		$status = "<span class='text-success strong'>확인</span>";
	}
?>
							<tr>
								<td><?=$recordcount-($j+(($npage-1)*$page_size))+1?></td>
								<td class="text-left"><a href="javascript:goView(<?=$rs['b_id']?>);"><?=$b_subject?></a></td>
								<td><?=$witerName?></td>
								<td><?=date("Y.m.d H:s:i", strtotime($rs['b_writeday']))?></td>
								<td><?=$status?></td>
							</tr>
<? $j++;} ?>
<? if($recordcount ==0){?>
							<tr>
								<td colspan="5">등록된 게시글이 없습니다.</td>
							</tr>
<? } ?>
						</tbody>
					</table>
					<div class="col-half">
<? include "inc/page_block.php";?>
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
var form = document.searchForm;

function goView(a) {
	form.search_text.value = encodeURI(form.search_text.value);
	form.b_idx.value = a;
	form.mode.value = "view";
	form.action = "contactUsView.php";
	form.submit();
}

function goSearch() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.submit();
}
</script>
</html>