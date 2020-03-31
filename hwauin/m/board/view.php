<?
$b_idx = $_GET['b_idx'];
if ($_GET['npage'] == "" || !$_GET['npage']) {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}$search_text = $_GET['search_text'];

$sql_view = "SELECT * FROM boardTable WHERE b_id='".$b_idx."'";
$rs_view = mysql_fetch_array(mysql_query($sql_view));

//조회수 올리기
$sql_update = "UPDATE boardTable SET b_hit = b_hit + 1 WHERE b_id='".$b_idx."'";
$rs_update = mysql_query($sql_update) or die(mysql_error());

//sns연동을 위한 변수들
$url = urlencode("sub.php?id=".$boardID."&npage=".$npage."&b_idx=".$b_idx."&ck=B&mode=view&search_text=".$search_text);
$ti = htmlspecialchars($rs_view['b_subject'])." > ".htmlspecialchars($rs_badmin['board_name']).">".htmlspecialchars($rs['siteTitle']);
$title_url = $ti.' : '.$url;
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="">
<meta name="description" content="">
<title><?=$rs_view['b_subject']?> > <?=htmlspecialchars($rs_badmin['board_name'])?> ><?=htmlspecialchars($rs['siteTitle'])?></title>
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
<script type="text/javascript" src="js/kakao.link.js"></script>
<script type="text/javascript">
  window.___gcfg = {lang: 'ko'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</head>
<body>
<? include "inc/top.php"; ?>
<div class="content-title">
    <h2><?=$rs_badmin['board_name']?></h2>
    <p><?=$rs_badmin['board_memo']?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<h3 class="uppercase"><?=$rs_badmin['board_name']?></h3>
		</div>
		<div class="decoration"></div>
		<div class="container">
			<div class="blog-post">
				<div class="post-content">
					<h4 class="text-primary"><?=$rs_view['b_subject']?></h4>
					<h6 class="text-muted full-bottom"><i class="fa fa-user"></i>&nbsp;<?=htmlspecialchars($rs_view['b_writerName'])?> / <i class="fa fa-clock-o"></i>&nbsp;<?=date('Y.m.d H:s:i', strtotime($rs_view['b_writeday']))?> / <i class="fa fa-hand-o-up"></i>&nbsp;<?=$rs_view['b_hit']?></h6>
					<p>
<? if($rs_view['file_names']!=""){if ($rs_badmin['type_id']==3){?>
						<img src="../board/upload_files/<?=$rs_view['file_names']?>" border="0">
<?}else{?>
						첨부파일 : <a href="../board/upload_files/<?=$rs_view['file_names']?>" target="_blank"><?=$rs_view['file_realnames']?></a>
<? } } ?>
					</p>
					<p><?=($rs_view['b_contents'])?></p>
				</div>
			</div>
        </div>
<? if($rs_badmin['type_id']==2){ ?>
<? if($rs_view['b_replyCnt']!=0 AND $rs_view['b_step']==0){ //답글 있을 때 ?>
<? 
$sqlre = "SELECT * FROM boardTable WHERE b_parent='".$b_idx."' AND b_parent!=b_id";
$rsre = mysql_fetch_array(mysql_query($sqlre));
?>
		<div class="decoration"></div>
		<div class="container">
			<div class="blog-post">
				<div class="post-content">
					<h4 class="text-success"><font color="red">[답변]</font>&nbsp;<?=htmlspecialchars($rsre['b_subject'])?></h4>
					<h6 class="text-muted full-bottom"><i class="fa fa-user"></i>&nbsp;<?=htmlspecialchars($rsre['b_writerName'])?> / <i class="fa fa-clock-o"></i>&nbsp;<?=date("Y.m.d H:s:i", strtotime($rsre['b_writeday']))?></h6>
					<p><?=htmlspecialchars($rsre['b_contents'])?></p>
				</div>
			</div>
        </div>
<? } ?>
<? } ?>
		<div class="decoration"></div>
		<div class="container center-text">
			<a href="sub.php?npage=<?=$npage?>&ck=B&id=<?=$boardID?>&search_text=<?=$search_text?>"><span class="button btn-sm button-warning">목록</span></a>
			<a href="write.php?npage=<?=$npage?>&ck=B&id=<?=$boardID?>&search_text=<?=$search_text?>&mode=modify&b_idx=<?=$b_idx?>"><span class="button btn-sm button-warning">수정</span></a>
			<a href="javascript:deleteForm();"><span class="button btn-sm button-warning">삭제</span></a>
<? if($rs_view['b_secretYN']=="N"){
 if (preg_match('/iPhone|iPod|iPad|BlackBerry|Android|Windows CE|LG|MOT|SAMSUNG|SonyEricsson|IEMobile|Mobile|lgtelecom|PPC|opera mobi|opera mini|nokia|webos/',$_SERVER['HTTP_USER_AGENT']) ) { // 모바일기기 일때만 접속 가능 ?>
			<a href="javascript:executeKakaoStoryLink();"><span class="button btn-sm button-warning">카스연동</span></a>
<?  $kakaotalk_imageurl = "http://".$_SERVER['HTTP_HOST']."/board/upload_files/".$rs['siteLogo'];// 카카오스토리 이미지 로고
	if(substr($rs_view['file_type'], 0, 5)=="image"){ //이미지파일이 게시글에 존재할 경우
		 $kakaotalk_imageurl ="http://".$_SERVER['HTTP_HOST']."/board/upload_files/".$rs_view['file_names'];
	} 
?>
<script type="text/javascript">
function executeKakaoStoryLink()
{
    kakao.link("story").send({   
        post : "http://gsi123.mireene.com/<?=$url?>",
        appid : "okmother.mireene.com",
        appver : "1.0",
        appname : "오리온네트웍스",
        urlinfo : JSON.stringify({title:"<?=$rs_view['b_subject']?>", desc:"<?=$rs_view['b_subject']?>", imageurl:["<?=$kakaotalk_imageurl?>"], type:"website"})
    });
}
</script>
<? } } ?>
			<a href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=http://gsi123.mireene.com/<?=$url?>&amp;p[title]=<?=urlencode($ti)?>"><span class="button btn-sm button-warning">페이스북</span></a>
			<a href="http://twitter.com/home?status=<?=$title_url?>"><span class="button btn-sm button-warning">트위터</span></a>
			<!-- <a href="https://plus.google.com/share?url=http://gsi123.mireene.com/<?=$url?>" target="_blank">
				<img title="" alt="구글플러스에 공유" src="images/gplus-32.png" style="width:32px;height:32px; position:relative; top:6px;">
			</a> -->
		</div>
<? if($rs_badmin['type_id']!=2){ 
if($rs_badmin['comment_yn']=="Y"){ //덧글 있을 때
	$sqlcomment = "SELECT * FROM board_comment WHERE board_id='".$boardID."' AND b_id=".$b_idx." ORDER BY c_id"; 

	$sqlcomment1 = "SELECT count(*) total FROM board_comment WHERE board_id='".$boardID."' AND b_id=".$b_idx." ORDER BY c_id"; 

	$rscomcount = mysql_fetch_array(mysql_query($sqlcomment1));
	$rscount = $rscomcount['total'];

	unset($rscomcount);
	unset($sqlcommnet1);
?>
<script type="text/javascript">
function _trim ( str ) { return str.replace(/(^\s*)|(\s*$)/g, ""); }

function getHTTPObject () {
	var xhr = false;
	if ( window.XMLHttpRequest ) { xhr = new XMLHttpRequest (); }
	else if ( window.ActiveXObject ) {
		try { xhr = new ActiveXObject ( "Msxml2.XMLHTTP" ); }
		catch ( e ) {
			try { xhr = new ActiveXObject ( "Microsoft.XMLHTTP" ); }
			catch ( e ) { xhr = false; }
		}
	}
	return xhr;
}

function grabFile ( file, func ) {
	var req = getHTTPObject ();
	if ( req ) {
		req.onreadystatechange = function () { eval(func+"(req)"); };
		req.open ( "GET", file, true );
		req.send(null);
	}
}

function ajaxOk ( req ) {	if ( req.readyState==4 && (req.status==200 || req.status==304) ) { return true; } else { return false; } }

function changeZsfImg() {
	document.getElementById("zsfImg").src="../nano/zmSpamFree/zmSpamFree.php?re&zsfimg="+new Date().getTime();
}

// AJAX를 이용한 스팸방지코드 검사
function checkZsfCode(obj) {
	var zsfCode = _trim(obj.value);	// 입력된 스팸방지코드의 값중 좌우 공백을 뺀 값
	if ( zsfCode.length > 0 ) {	// 스팸방지코드값이 입력된 경우
	grabFile ( "../nano/zmSpamFree/zmSpamFree.php?zsfCode="+zsfCode, "resultZsfCode" );	// 스팸방지코드값을 검증하여 결과값을 resultZsfCode 함수로 넘김
	}
}
// 스팸방지코드 검사결과를 hidden 폼에 입력시킴
function resultZsfCode(req) {
	if ( ajaxOk(req) ) {
		var ret = req.responseText*1;	// AJAX 결과물값을 숫자 데이터로 변환
		document.getElementById("zsfCodeResult").value = ret;	// hidden 폼에 입력
		if ( !ret ) { changeZsfImg(); }	// AJAX 결과물값이 0일 경우 캅차 이미지 바꿈
	}
}
function checkFrm() {
	var zsfCode = _trim(document.getElementById("zsfCode").value);	// 스팸방지코드값에서 공백 제거
	if ( !zsfCode ) {	// 스팸방지코드값이 없을 경우
		alert ("스팸방지코드를 입력해 주세요.");
		document.getElementById("zsfCode").focus();	// 스팸방지코드 입력폼에 focus
		return false;
	}
	if ( document.getElementById("zsfCodeResult").value*1 < 1 ) {	// 검사결과값이 거짓(0)일 경우
		alert ("스팸방지코드가 틀렸습니다. 다시 입력해 주세요.");
		changeZsfImg();	// 캅챠 이미지 새로 바꿈 (생략 가능)
		document.getElementById("zsfCode").value="";	// 스팸방지코드 입력폼 값 제거
		document.getElementById("zsfCode").focus();		// 스팸방지코드 입력폼에 focus
		return false;
	}
}
</script>
		<div class="decoration"></div>
		<div class="container">
			<div class="contact-form no-bottom"> 
                <form name="commentForm" action="../board/commentProcess.php" method="post" class="contactForm">
                    <fieldset>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField" for="b_commentWriter">댓글 작성자</label>
                            <input type="text" name="b_commentWriter" value="" class="contactField contactNameField" id="b_commentWriter">
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField" for="b_comment">댓글 내용</label>
							<textarea name="b_comment" class="contactTextarea" id="b_comment"></textarea>
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">댓글 비밀번호</label>
                            <input type="password" name="b_commentPW" value="" class="contactField contactNameField">
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">스팸방지 (글자 클릭시 새 코드 생성)</label>
							<div class="column">
								<div class="one-half">
									<input name="zsfCode" id="zsfCode" type="text" class="contactField contactNameField" onblur="checkZsfCode(this);" maxlength="4"><input type="hidden" id="zsfCodeResult" name="zsfCodeResult">
								</div>
								<div class="one-third no-left">
									<img id="zsfImg" src="../nano/zmSpamFree/zmSpamFree.php?zsfimg&re" style="border: none; cursor: pointer; height: 30px;" onclick="this.src='../nano/zmSpamFree/zmSpamFree.php?re&amp;zsfimg='+new Date().getTime(); document.commentForm.zsfCode.value='';">
								</div>
							</div>
                        </div>
						<div class="center-text">
							<a href="javascript:commentCheckForm();"><span class="button btn-sm button-inverse">댓글 등록</span></a>
						</div>
                    </fieldset>
				<input type="hidden" name="id" value="<?=$boardID?>">
				<input type="hidden" name="b_idx" value="<?=$b_idx?>">
				<input type="hidden" name="ck" value="B">
				<input type="hidden" name="mode" value="view">
				<input type="hidden" name="npage" value="<?=$npage?>">
				<input type="hidden" name="search_text" value="<?=$search_text?>">
                </form>
			</div>
		</div>
<script type="text/javascript">
function commentCheckForm() {
	if (document.commentForm.b_commentWriter.value == "") {
		alert('작성자를 입력하세요.');
		document.commentForm.b_commentWriter.focus();
	} else if (document.commentForm.b_comment.value == "") {
		alert('내용을 입력하세요.');
		document.commentForm.b_comment.focus();
	} else if (document.commentForm.b_commentPW.value.length < 4) {
		alert('비밀번호를 4자 이상 입력하세요.');
		document.commentForm.b_commentPW.focus();
	} else if (document.commentForm.zsfCodeResult.value != 1 || document.commentForm.zsfCode.value == "") {
		checkFrm();
	} else {
		if (confirm('작성하신 댓글을 등록하시겠습니까?')==1) {
			document.commentForm.submit();
			return true;
		}
	}
}
function commentDeleteForm(a) {
	if (confirm('삭제된 댓글은 복구할 수 없습니다. 삭제를 진행하시겠습니까?')==1) {
		document.commentDelForm.c_idx.value = a;
		document.commentDelForm.submit();
		return true;
	}
}
</script>
<?	if($rscount!=0){?>
		<div class="decoration"></div>
		<div class="container">
<?	$resultcomment = mysql_query($sqlcomment) or die(mysql_error());
	$i=1;
	while($rscomment = mysql_fetch_array($resultcomment)) {?>	
			<p><i class="fa fa-user"></i>&nbsp;<?=$rscomment['c_writerName']?>&nbsp;/&nbsp;<i class="fa fa-clock-o"></i>&nbsp; <?=date('Y.m.d H:i:', strtotime($rscomment['c_regDate']))?>&nbsp;/&nbsp;<a href="javascript:commentDeleteForm(<?=$rscomment['c_id']?>);"><i class="fa fa-trash-o"></i>삭제</a><br><?=$rscomment['c_contents']?></p>
			<div class="decoration"></div>
<? } ?>
			<form name="commentDelForm" action="password.php" method="get" class="contactForm">
			<input type="hidden" name="id" value="<?=$boardID?>">
			<input type="hidden" name="b_idx" value="<?=$b_idx?>">
			<input type="hidden" name="c_idx" value="">
			<input type="hidden" name="ck" value="B">
			<input type="hidden" name="mode" value="commentDelete">
			<input type="hidden" name="npage" value="<?=$npage?>">
			<input type="hidden" name="search_text" value="<?=$search_text?>">
			</form>
		</div>
<? }}} ?>
		<form name="viewForm" action="password.php" method="get">
		<input type="hidden" name="ck" value="B">
		<input type="hidden" name="nowFile" value="<?=$rs_view['file_names']?>">
		<input type="hidden" name="id" value="<?=$boardID?>">
		<input type="hidden" name="b_idx" value="<?=$b_idx?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<input type="hidden" name="npage" value="<?=$npage?>">
		<input type="hidden" name="search_text" value="<?=$search_text?>">
		</form>
	</div>
</div>
<?include "inc/bottom.php";?>
</body>
<script type="text/javascript">
var form = document.viewForm;

function deleteForm() {
	if (confirm('삭제된 글과 첨부파일은 복구할 수 없습니다. 삭제를 진행하시겠습니까?')==1) {
		form.mode.value = "delete";
		form.submit();
		return true;
	}
}
<? if($rs_view['b_replyCnt']!=0 AND $rs_view['b_step']==0){ ?>

function deleteForm() {
	alert('답변이 있는 상태의 글은 삭제하실 수 없습니다.');
}
<? } ?>
</script>
</html>