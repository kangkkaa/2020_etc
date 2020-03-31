<? include "inc/link.php"; ?>
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$sql_main ="SELECT * FROM mainConfig WHERE idx=1";
$rs_min = mysql_fetch_array(mysql_query($sql_main));

$sql_con1 = "SELECT * FROM contentConfig WHERE idx='".$rs_min['service1_link']."'";
$rs_c1 = mysql_fetch_array(mysql_query($sql_con1));

$sql_con2 = "SELECT * FROM contentConfig WHERE idx='".$rs_min['service2_link']."'";
$rs_c2 = mysql_fetch_array(mysql_query($sql_con2));

$sql_con3 = "SELECT * FROM contentConfig WHERE idx='".$rs_min['service3_link']."'";
$rs_c3 = mysql_fetch_array(mysql_query($sql_con3));

if($rs_min['service1_link']==0){
	$link11 ="#";
}else{
	$link11 = "sub.php?ck=".$rs_c1['contentKind']."&id=".$rs_c1['contentId'];
}
if($rs_min['service2_link']==0){	
	$link2 ="#";
}else{
	$link2 = "sub.php?ck=".$rs_c2['contentKind']."&id=".$rs_c2['contentId'];
}
if($rs_min['service3_link']==0){
	$link3 ="#";
}else{
	$link3 = "sub.php?ck=".$rs_c3['contentKind']."&id=".$rs_c3['contentId'];
}

$sql_board = "SELECT * FROM contentConfig WHERE idx='".$rs_min['b_contentValue']."'";
$rs_board = mysql_fetch_array(mysql_query($sql_board));

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="<?=$rs_min['siteTag']?>">
<meta name="description" content="<?=$rs_min['siteDescription']?>">
<title><?=$rs_min['siteTitle']?></title>
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
<!-- 팝업레이어 시작 { -->
<?
unset($sql);
unset($result);
$time = date("Y-m-d H:s:i",time());
$sql = "SELECT * FROM popupAdmin WHERE '".$time."' between po_starttime and po_endtime ORDER BY idx asc";
$result = mysql_query($sql) or die(mysql_error());
?>
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>
<?
for ($i=0; $row_po=mysql_fetch_array($result); $i++){
	if($_COOKIE["hd_pops_{$row_po['idx']}"])	continue; //24시간 안보기 체크

	$sql_po = "SELECT * FROM popupAdmin WHERE idx='".$row_po['idx']."'";
	$po = mysql_fetch_array(mysql_query($sql_po));
?>
    <div id="hd_pops_<?=$po['idx']?>" class="hd_pops" style="top:<?=$po['po_top']?>px;left:<?=$po['po_left']?>px">
		<a href="<?=$po['po_link']?>" target="<?=$po['po_target']?>">
		<div class="hd_pops_con" style="width:<?=$po['po_width']?>px;height:<?=$po['po_height']?>px">
            <div><?=$po['po_contents']?></div>
        </div>
		</a>
        <div class="hd_pops_footer">
            <button class="hd_pops_reject hd_pops_<?=$po['idx']?> <?=$po['po_time']?>"><strong><?=$po['po_time']?></strong>시간 동안 다시 열람하지 않습니다.</button>
            <button class="hd_pops_close hd_pops_<?=$po['idx']?>">닫기</button>
        </div>
    </div>
<? } ?>
</div>
<script>
$(function() {
<?	$result = mysql_query($sql) or die(mysql_error());
while($rowp=mysql_fetch_array($result)){
	if($_COOKIE["hd_pops_{$rowp['idx']}"])	continue;?> 
	$("#hd_pops_<?=$rowp['idx']?>").draggable();
<? } ?>
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[1];
        var exp_time = parseInt(id[2]);
		var domain = ".gsi123.mireene.com";
        $("#"+id[1]).css("display", "none");
        set_cookie(ck_name, 1, exp_time, domain);
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
        $('#'+idb[1]).css('display','none');
    });
});

function set_cookie(name, value, expirehours, domain){
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}
</script>
<!-- } 팝업레이어 끝 -->
<? include "inc/top.php"?>
<? if($rs_min['mainimageYN']=="Y"){?>
<div>
    <div class="bxslider">
<? $sqlI = "SELECT * FROM imageSlider ORDER BY sortNo";
   $resultI = mysql_query($sqlI) or die(mysql_error());
   while($rsI = mysql_fetch_array($resultI)){
		$sql_ima ="SELECT * FROM contentConfig WHERE idx=".$rsI['mainImage_link'];
		$rs_ima = mysql_fetch_array(mysql_query($sql_ima));

	   if($rsI['mainImage_link']==0){
			$linkI ="#";
		}else{
			$linkI = "sub.php?ck=".$rs_ima['contentKind']."&id=".$rs_ima['contentId'];
		}
?>
		<div>
			<a href='<?=$linkI?>'><img src='board/upload_files/<?=$rsI['file_name']?>'></a>
			<blockquote class="slider-caption">
				<h2><?=$rsI['mainImage_Title']?></h2>
				<p><?=$rsI['mainText']?></p>
            </blockquote>
        </div>
<? } ?>
    </div>
</div>
<? } ?> 
<div class="content no-bottom">
<? if($rs_min['service1_YN']=="Y"){?>
	<div class="container no-bottom">
    	<h2><a href="<?=$link11?>"><?=$rs_min['serviceTitle1']?></a></h2>
        <p><?=$rs_min['serviceText1']?></p>
    </div>
    <div class="decoration"></div>
<? } ?>
<? if($rs_min['service2_YN']=="Y"){?>
	<div class="container no-bottom">
    	<h2><a href="<?=$link2?>"><?=$rs_min['serviceTitle2']?></a></h2>
        <p><?=$rs_min['serviceText2']?></p>
    </div>
    <div class="decoration"></div>
<? } ?>
<? if($rs_min['service3_YN']=="Y"){?>
	<div class="container">
    	<h2><a href="<?=$link3?>"><?=$rs_min['serviceTitle3']?></a></h2>
        <p><?=$rs_min['serviceText3']?></p>
    </div>
	<div class="decoration"></div>
<? } ?>
</div>
<? if($rs_min['board_useYN']=="Y"){?>
<div class="content no-bottom">
	<div class="container half-top half-bottom">
<? 
$page_size = 3;
$npage = 1;
if($rs_board['contentId']!=""){
	$sql_admin = "SELECT * FROM boardAdmin WHERE board_id='".$rs_board['contentId']."'"; 
	$rsl_admin = mysql_fetch_array(mysql_query($sql_admin));
	$boardName = $rsl_admin['board_name'];
	
	$sql = "SELECT COUNT(*) total_count FROM boardTable WHERE board_id='".$rs_board['contentId']."' AND b_parent=b_id";
	$sql_badmin = "SELECT * FROM boardTable WHERE board_id='".$rs_board['contentId']."' AND b_parent=b_id ORDER BY b_writeday DESC LIMIT ".(($npage-1) * $page_size).", ".$page_size; 
}else{
	$sql = "SELECT COUNT(*) total_count FROM boardTable WHERE b_parent=b_id";
	$sql_badmin = "SELECT * FROM boardTable WHERE b_parent=b_id ORDER BY b_writeday DESC LIMIT ".(($npage-1) * $page_size).", ".$page_size;
	$boardName = "최신 게시판";
}
	$result_badmin = mysql_query($sql_badmin);
	$rs = mysql_fetch_array(mysql_query($sql));
	$recordcount = $rs['total_count'];
	unset($rs);
?>
		<h4><b><i class="fa fa-list-alt"></i>&nbsp;&nbsp;<?=$boardName?></b></h4>
	</div>
	<table>
<? while($rs_badmin =  mysql_fetch_array($result_badmin)){ 
	if ($rs_badmin['b_commentCnt'] == 0) {//덧글이 있을 때 제목 옆에 덧글 수 나타나게 하는것.
		$comment_cnt = "";
	} else {
		$comment_cnt = "<font color='orange'>[".$rs_badmin['b_commentCnt']."]</font>";
	}

	if ($comment_cnt == "") {
		$b_subject = mb_strimwidth($rs_badmin['b_subject'], 0, 60, " ...", "UTF-8");
	} else {
		$b_subject = mb_strimwidth($rs_badmin['b_subject'], 0, 58, " ...", "UTF-8");
	}

	if ($rs_badmin['b_secretYN'] == "Y") {
		$secret = "Y";
		$secretIcon ="<i class='fa fa-lock'></i>&nbsp;";
	} else {
		$secret = "N";
		$secretIcon ="";
	}
		$today = date("Y.m.d", time(0));
		$writeday=date('Y.m.d', strtotime($rs_badmin['b_writeday']));
	if($today==$writeday){
		$b_new="<span style='background: #EEA32C; color: #fff; font-size: 11px; padding: 2px;box-shadow: 2px 2px 0px #ccc;'>&nbsp;<i class='fa fa-exclamation'></i>&nbsp;새글</span>";
	}else{
		$b_new="";
	}
		$b_title = mb_strimwidth($rs_badmin['b_title'], 0, 80, " ...", "UTF-8");
		$b_title = $b_title." ".$comment_cnt.$b_secret_icon.$b_new;
		$witerName = mb_strimwidth($rs_badmin['b_writerName'], 0,25, " ...", "UTF-8");

	if ($rs_badmin['b_replyYN']=="Y"){
		$reply="<span class='label label-sm label-success'><i class='fa fa-reply'></i>&nbsp;&nbsp;답변</span>";
	}else if($rs_badmin['b_replyYN']=="N"){
		$reply="<span class='label label-sm label-danger'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;대기</span>";
	}
	$b_subject = $secretIcon.$b_subject." ".$comment_cnt;
?>
		<tr>
			<td><a href="javascript:goView(<?=$rs_badmin['b_id']?>, '<?=$secret?>', '<?=$rs_badmin['board_id']?>');"><?=$b_subject?></a></td>
		</tr>
<? } ?>
<? if($recordcount==0){ ?>
		<tr>
			<td>작성글이 없습니다.</td>
		</tr>
<? } ?>
	</table>
	<form name="boardForm" action="?" method="get">
	<input type="hidden" name="id" value="<?=$rsl_admin['board_id']?>">
	<input type="hidden" name="npage" value="<?=$npage?>">
	<input type="hidden" name="b_idx" value="">
	<input type="hidden" name="ck" value="B">
	<input type="hidden" name="mode" value="view">
	<input type="hidden" name="search_text" value="">
	</form>
</div>
<? } ?>
<script type="text/javascript">
var form = document.boardForm;

function goView(a, b, c) {
	form.search_text.value = encodeURI(form.search_text.value);
	form.b_idx.value = a;
	form.id.value = c;
	if (b == "N") {
		form.action = "sub.php";
	} else if (b == "Y") {
		form.action = "password.php";
	}
	form.submit();
}
</script>
<? include "inc/bottom.php"; ?>
</body>
</html>