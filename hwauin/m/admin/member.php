<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

//회원
if ($_GET['npage'] == "") {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}

$page_block = 10;
$page_size = 10;

$sqlm = "SELECT COUNT(*) total_count FROM m_member WHERE mem_level LIKE '1'";


$sqlmlist = "SELECT * FROM m_member WHERE mem_level LIKE '1'";
if ($_GET['search_text'] != "") {
	$sqlm = $sqlm."AND (mem_id LIKE '%".urldecode($_GET['search_text'])."%' OR mem_name LIKE '%".urldecode($_GET['search_text'])."%' OR mem_email LIKE '%".urldecode($_GET['search_text'])."%')"; //" AND ".$_GET['search_opt']." LIKE '%".$_GET['search_text']."%'";
	$sqlmlist = $sqlmlist." AND (mem_id LIKE '%".urldecode($_GET['search_text'])."%' OR mem_name LIKE '%".urldecode($_GET['search_text'])."%' OR mem_email LIKE '%".urldecode($_GET['search_text'])."%')";
}
$rscount = mysql_fetch_array(mysql_query($sqlm));
$recordcountm = $rscount['total_count'];
unset($rscount);

$sqlmlist = $sqlmlist." ORDER BY join_date DESC LIMIT ".(($npage-1) * $page_size).", ".$page_size;
$resultm = mysql_query($sqlmlist) or die(mysql_error());
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
					<form name="searchForm" id="searchForm" action="?" method="get">
					<input type="hidden" name="npage" value="<?=$npage?>">
					<input type="hidden" name="midx" value="">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="processMode" value="insert">
						<div class="form-inline pull-left">
							<input type="text" placeholder="아이디, 이름, 이메일 통합검색" name="search_text" value="<?=urldecode($_GET['search_text'])?>" class="form-control" style="width: 200px;">
							<button type="submit" class="button button-light btn-sm"><i class="fa fa-search"></i>&nbsp;검색</button>
						</div>
					</form>
					<table class="table table-striped table-hover">
						<thead>
							<tr class="text-primary info">
								<th>No</th>
								<th>아이디</th>
								<th>이름</th>
								<th>이메일</th>
								<th>연락처</th>
								<th>가입일</th>
								<th>탈퇴일</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody class="text-center">
<? 
$j=1;
while ($rs_mem = mysql_fetch_array($resultm)) {
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
?>
							<tr>
								<td><?=$recordcountm-($j+(($npage-1)*$page_size))+1?></td>
								<td><a href="javascript:goView(<?=$rs_mem['idx']?>);"><?=$rs_mem['mem_id']?></a></td>
								<td><a href="javascript:goView(<?=$rs_mem['idx']?>);"><?=$rs_mem['mem_name']?></a></td>
								<td><?=$rs_mem['mem_email']?></td>
								<td><?=$rs_mem['mem_tel']?></td>
								<td><?=date("Y.m.d", strtotime($rs_mem['join_date']))?></td>
								<td><?=$exit?></td>
								<td><?=$status?></td>
							</tr>
<?	$j++; } unset($rs_mem); ?>
<? if ($recordcountm == 0) { ?>
							<tr>
								<td colspan="8">가입된 회원이 없습니다.</td>
							</tr>
<? } ?>
						</tbody>
					</table>
					<div class="col-half">
<? include "inc/page_block.php";?>
					</div>
					<div class="col-half col-last text-right">
						<button type="button" class="button button-default btn-sm notopmargin" onclick="goWrite();"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;회원 추가</button>
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
	form.midx.value = a;
	form.action = "member-view.php";
	form.submit();
}

function goWrite() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.action = "member_add.php";
	form.submit();
}

function goSearch() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.submit();
}
</script>
</html>