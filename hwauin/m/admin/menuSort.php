<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$midx = $_GET['midx']; 

$listsql = "SELECT * FROM menuAdmin WHERE dept='1' ORDER BY sortNo";
$resultli = mysql_query($listsql) or die(mysql_error());
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
$page = "menuConfig";
include "inc/left.php"; ?>	
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">사이트 메뉴 설정</h3>
				<div class="col-full nobottommargin topmargin">
					<a href="menuWrite.php"><span class="button button-success btn-sm notopmargin"><i class="fa fa-plus"></i>&nbsp;&nbsp;신규 메뉴 추가</span></a> 
					<a href="menuSort.php"><span class="button button-danger btn-sm notopmargin"><i class="fa fa-sort"></i>&nbsp;&nbsp;메뉴 정렬 설정</span></a> 
					<a href="menuConfig.php"><span class="button button-info btn-sm notopmargin"><i class="fa fa-sitemap"></i>&nbsp;&nbsp;전체 메뉴 목록</span></a>
				</div>
				<div class="col-full nobottommargin">
					<div class="divider"></div>
				</div>
				<form name="menuForm" action="menuSort.php" method="get">
					<div class="col-half">
						<table class="table">
							<thead>
								<tr class="text-danger">
									<th colspan="4" class="text-left"><b>대메뉴 목록</b></th>
								</tr>
							</thead>
							<thead>
								<tr class="text-primary info">
									<th>정렬</th>
									<th>메뉴 이름</th>
									<th>연결 컨텐츠</th>
									<th>소메뉴 정렬</th>
								</tr>
							</thead>
							<tbody class="text-center">
<? while($mrs = mysql_fetch_array($resultli)){ ?>
<? 	//연결 콘텐츠
	$sqllink="SELECT * FROM contentConfig WHERE idx='".$mrs['contentIdx']."'";
	$rslink = mysql_fetch_array(mysql_query($sqllink));
?>
								<tr <?if($midx==$mrs['idx']) {echo("class='danger'");}?>>
									<td class="text-danger">
										<a href="javascript:mainMenuChange(<?=$mrs['idx']?>, 'mup', <?=$mrs['sortNo']?>);"><i class="fa fa-caret-square-o-up fa-lg"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="javascript:mainMenuChange(<?=$mrs['idx']?>, 'mdown', <?=$mrs['sortNo']?>);"><i class="fa fa-caret-square-o-down fa-lg"></i></a>
									</td>
									<td class="text-left"><b><font color="red"><i class="fa fa-plus"></i></font>&nbsp;&nbsp;<?=$mrs['menuName']?></b></td>
									<td><?=$rslink['contentName']?></td>
									<td><a href="javascript:subMenuList(<?=$mrs['idx']?>);"><span class="label label-warning"><i class="fa fa-sort-amount-desc"></i></span></a></td>
								</tr>
<? } ?>
							</tbody>
						</table>
					</div>
<? if($midx!=""){ ?>
<?
//소메뉴 있는지 없는지
$sqlcount = "SELECT COUNT(*) total_count FROM menuAdmin WHERE dept='2' AND mainMenu ='".$midx."' ORDER BY sortNo";
$rssount = mysql_fetch_array(mysql_query($sqlcount));
$recordcount = $rssount['total_count'];
unset($rssount);
//소메뉴 list 뽑기
$subsql = "SELECT * FROM menuAdmin WHERE dept='2' AND mainMenu ='".$midx."' ORDER BY sortNo";
$subresult = mysql_query($subsql) or die(mysql_error()); 
//대메뉴 이름
$sqlmn = "SELECT * FROM menuAdmin WHERE dept='1' AND idx='".$midx."'";
$mnrs = mysql_fetch_array(mysql_query($sqlmn));
?>
					<div class="col-half col-last">
						<table class="table">
							<thead>
								<tr class="text-success">
									<th colspan="3" class="text-left"><b><i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;<font class="text-danger">[<?=$mnrs['menuName']?>]</font> 대메뉴에 연결된 소메뉴 목록</b></th>
								</tr>
							</thead>
							<thead>
								<tr class="text-primary info">
									<th>정렬</th>
									<th>메뉴 이름</th>
									<th>연결 컨텐츠</th>
								</tr>
							</thead>
							<tbody class="text-center">
<? unset($mnrs); ?>
<? if($recordcount==0){ ?>
								<tr>
									<td colspan="3">연결된 소메뉴가 없습니다.</td>
								</tr>
<? } ?>
<? 
while($surs = mysql_fetch_array($subresult)){ ?>
<? 	//연결 콘텐츠
	$sqllink1="SELECT * FROM contentConfig WHERE idx='".$surs['contentIdx']."'";
	$rslink1 = mysql_fetch_array(mysql_query($sqllink1));
?>
								<tr>
									<td class="text-danger">
										<a href="javascript:mainMenuChange(<?=$surs['idx']?>, 'sup', <?=$surs['sortNo']?>);"><i class="fa fa-caret-square-o-up fa-lg"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="javascript:mainMenuChange(<?=$surs['idx']?>, 'sdown', <?=$surs['sortNo']?>);"><i class="fa fa-caret-square-o-down fa-lg"></i></a>
									</td>
									<td class="text-left"><b><font color="orange"><i class="fa fa-minus"></i></font>&nbsp;&nbsp;<?=$surs['menuName']?></b></td>
									<td><?=$rslink1['contentName']?></td>
								</tr>
<? } ?>
							</tbody>
						</table>
					</div>
<? } ?>
				<input type="hidden" name="midx" value="<?=$midx?>">
				<input type="hidden" name="mode" value="">
				<input type="hidden" name="ridx" value="">
				<input type="hidden" name="sortnum" value="">
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
<script type="text/javascript">
function subMenuList(a) {
	document.menuForm.midx.value = a;
	document.menuForm.submit();
}

function mainMenuChange(a, b, c) {
	document.menuForm.ridx.value = a;
	document.menuForm.mode.value = b;
	document.menuForm.sortnum.value = c;
	document.menuForm.method = "post";
	document.menuForm.action = "menuSortProcess.php";
	document.menuForm.submit();
}
</script>
</html>