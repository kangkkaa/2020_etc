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
<?
$j = 1;
while ($rs = mysql_fetch_array($result)) {
	$writeday = date('Y.m.d', strtotime($rs['b_writeday']));
	if ($rs['file_names']!=""){
		$image = "../board/upload_files/".$rs['file_names'];
	}else{
		$image = "images/noimg.jpg";
	}
	if($rs['b_secretYN']=="Y"){
		$secretIcon ="<i class='fa fa-lock'></i>&nbsp;";
	}else{
		$secretIcon ="";
	}
?>
			<div class="container">
				<div class="colurm">
					<div class="one-half">
						<a href="javascript:goView(<?=$rs['b_id']?>, '<?=$rs['b_secretYN']?>');"><img src="<?=$image?>" class="responsive-image"></a>
					</div>
					<div class="one-half">
						<h5><a href="javascript:goView(<?=$rs['b_id']?>, '<?=$rs['b_secretYN']?>');"><font color="#336699"><?=$secretIcon?><?=$rs['b_subject']?></font></a></h5>
						<h6 class="text-muted"><small><i class="fa fa-user"></i>&nbsp;<?=$rs['b_writerName']?></h6>
						<h6 class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?=$writeday?></small></h6>
						<h6 class="text-muted"><?=$rs['b_contents']?></h6>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="decoration"></div>
<? $j++;} ?>
<? if($recordcount==0){ ?>
			<div class="decoration"></div>
			<table>
				<tbody>
					<tr>
						<td class="center-text">등록된 게시글이 없습니다.</td>
					</tr>
				</tbody>
			</table>
			<div class="decoration"></div>
<? } ?>
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