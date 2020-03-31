<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$b_idx = $_GET['b_idx'];
$npage = $_GET['npage'];
$mode = $_GET['mode'];
$search_text = $_GET['search_text'];
$sql_view = "SELECT * FROM boardTable WHERE board_id='contactusOrionnet' AND b_id='".$b_idx."'";
$rs_view = mysql_fetch_array(mysql_query($sql_view));

$sqlupdate = "UPDATE boardTable SET b_hit=b_hit+1 WHERE b_id=".$b_idx;
mysql_query($sqlupdate) or die(mysql_error());
unset($sqlupdate);
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
					<span class="date-box">
						<h4><?=date("d", strtotime($rs_view['b_writeday']))?></h4>
						<span><?=date("m", strtotime($rs_view['b_writeday']))?>월</span>
					</span>
					<h3 class="date-title"><?=$rs_view['b_subject']?></h3>
					<ul class="list-inline text-muted">
						<li><i class="fa fa-user"></i><?=$rs_view['b_writerName']?><span></span></li>
						<li><i class="fa fa-clock-o"></i><?=date("Y.m.d H:s:i", strtotime($rs_view['b_writeday']))?><span></span></li>
					</ul>
				</div>
				<div class="col-full">
					<p>연락처 : <?=$rs_view['c_mobile']?><br/>
					   이메일 : <?=$rs_view['c_mail']?><br/><br/>
					   <?=$rs_view['b_contents']?></p>
				</div>
				<div class="clear double-divider"></div>
				<div class="text-center">
					<button type="button" class="button button-default btn-sm" onclick="location.href='contactUs.php?npage=<?=$npage?>&search_text=<?=$search_text?>';"><i class="fa fa-bars left-icon"></i>목록</button>
					<button type="button" class="button button-primary btn-sm" onclick="deleteForm();"><i class="glyphicon glyphicon-trash left-icon"></i>삭제</button>
				</div>
				<form name="viewForm" action="contactUsProcess.php" method="post">
				<input type="hidden" name="b_idx" value="<?=$b_idx?>">
				<input type="hidden" name="mode" value="<?=$mode?>">
				<input type="hidden" name="npage" value="<?=$npage?>">
				<input type="hidden" name="search_text" value="<?=$search_text?>">
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
	if (confirm('삭제된 문의글은 복구할 수 없습니다. 현재 문의글을 삭제하시겠습니까?')==1) {
		form.mode.value = "delete";
		form.submit();
		return true;
	}
}
</script>
</html>