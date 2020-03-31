<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="<?=$rs_badmin['siteTag']?>">
<meta name="description" content="<?=$rs_badmin['siteDescription']?>">
<title><?=$rs_badmin['siteTitle']?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/button.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/basic.css" rel="stylesheet" type="text/css">
<link href="css/bxslider.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="js/hammer.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-min.js"></script>
<script type="text/javascript" language="javascript" src="js/bxslider.js"></script>
<script type="text/javascript" language="javascript" src="js/custom.js"></script>
<script type="text/javascript" language="javascript" src="js/framework.js"></script>
</head>
<body>
<? include "inc/top.php"; ?>
<div class="content-title">
    <h2><?=$rs_badmin['board_name']?></h2>
    <p><?=$rs_badmin['board_memo']?></h4>
</div>
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
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<form name="searchForm" id="searchForm" action="?" method="get">
			<input type="hidden" name="id" value="<?=$_GET['id']?>">
			<input type="hidden" name="npage" value="<?=$npage?>">
			<input type="hidden" name="b_idx" value="">
			<input type="hidden" name="ck" value="B">
			<input type="hidden" name="mode" value="<?=$_GET['mode']?>">
				<div class="column">
					<div class="two-third"><input type="text" name="search_text" placeholder="제목,내용,작성자 통합검색" value="<?=urldecode($_GET['search_text'])?>" class="contactField"></div>
					<div class="one-third no-left"><a href="#" onclick="goSearch();"><span class="button btn-sm button-inverse"><i class="fa fa-search"></i>&nbsp;검색</span></a></div>
				</div>
			</form>
		</div>
		<div class="container no-bottom">
			<table>
				<thead>
					<tr>
						<th width="65%" class="text-primary">제목</th>
						<th width="35%" class="text-primary">작성일</th>
					</tr>
				</thead>
				<tbody>
<?
$no_sqllist = "SELECT * FROM boardTable WHERE board_id='".$boardID."' AND b_parent=b_id AND b_noticeYN='Y'";
$result_no = mysql_query($no_sqllist) or die(mysql_error());
while ($rs_no = mysql_fetch_array($result_no)) {
	$witerName = mb_strimwidth($rs_no['b_writerName'], 0,25, " ...", "UTF-8");
	$writeday = date('Y.m.d H:s:i', strtotime($rs_no['b_writeday']));
	if ($rs_no['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font color='orange'>[".$rs_no['b_commentCnt']."]</font>";
	}
?>
					<tr class="bg-light-notice">
						<td><i class="fa fa-bullhorn"></i> <a href="javascript:goView(<?=$rs_no['b_id']?>, 'N');"><?=$rs_no['b_subject']." ".$comment_cnt?> </a></td>
						<td class="center-text">2014.01.15</td>
					</tr>
<? }
$j = 1;
while ($rs = mysql_fetch_array($result)) {
	if ($rs['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font color='orange'>[".$rs['b_commentCnt']."]</font>";
	}
	if ($comment_cnt == "") {
		$b_subject = mb_strimwidth($rs['b_subject'], 0, 60, " ...", "UTF-8");
	} else {
		$b_subject = mb_strimwidth($rs['b_subject'], 0, 58, " ...", "UTF-8");
	}

	if ($rs['b_secretYN'] == "Y") {
		$secret = "Y";
		$secretIcon ="<i class='fa fa-lock'></i>&nbsp;";
	} else {
		$secret = "N";
		$secretIcon ="";
	}
		$today = date("Y.m.d", time(0));
		$writeday=date('Y.m.d', strtotime($rs['b_writeday']));
	if($today==$writeday){
		$b_new="<span class='new'></i>&nbsp;새글</span>";
	}else{
		$b_new="";
	}

	if ($rs['b_replyYN']=="Y"){
		$reply="<span class='label label-sm label-success'><i class='fa fa-reply'></i>&nbsp;&nbsp;답변</span>";
	}else if($rs['b_replyYN']=="N"){
		$reply="<span class='label label-sm label-danger'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;대기</span>";
	}
	$b_subject = $secretIcon.$b_subject.$comment_cnt;
?>
					<tr>
						<td><a href="javascript:goView(<?=$rs['b_id']?>, '<?=$rs['b_secretYN']?>');"><?=$b_subject?></a></td>
						<td class="center-text"><?=$writeday?></td>
					</tr>
<? $j++;} ?>
<? if($recordcount==0){ ?>
					<tr>
						<td colspan="2" class="center-text">등록된 게시글이 없습니다.</td>
					</tr>
<? } ?>
				</tbody>
			</table>
        </div>
		<div class="container center-text">
<?include "inc/page_block.php";?>
		</div>
		<div class="container right-text">
			<a href="javascript:goWrite();"><span class="button btn-sm button-inverse">글쓰기</span></a>
		</div>
	</div>
</div>
<? include "inc/bottom.php"; ?>
</body>
<script type="text/javascript">
var form = document.searchForm;

function goView(a, b) {
	form.search_text.value = encodeURI(form.search_text.value);
	form.b_idx.value = a;
	form.mode.value = "view";
	if (b == "N") {
		form.action = "../sub.php";
	} else if (b == "Y") {
		form.action = "password.php";
	}
	form.submit();
}
function goWrite() {
	form.search_text.value = encodeURI(form.search_text.value);
	form.mode.value = "insert";
	form.action = "write.php";
	form.submit();
}
function goSearch() {
	form.npage.value = 1;
	form.search_text.value = encodeURI(form.search_text.value);
	form.submit();
}
</script>
</html>