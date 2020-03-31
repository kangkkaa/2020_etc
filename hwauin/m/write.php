<? include "inc/link.php" ?>
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
$mode = $_GET['mode'];

$boardID = $_GET['id'];
if ($_GET['npage'] == "") {
	$npage = 1;
} else {
	$npage = $_GET['npage'];
}
$b_idx = $_GET['b_idx'];
$search_text = $_GET['search_text'];

$sql_badmin = "SELECT * FROM boardAdmin WHERE board_id='".$boardID."' AND status='Y'";
$result_badmin = mysql_query($sql_badmin) or die(mysql_error());
$rs_badmin = mysql_fetch_array($result_badmin);

if($mode == "modify"){
	$sql_mo = "SELECT * FROM boardTable WHERE b_id = ".$b_idx;
	$rs_mo = mysql_fetch_array(mysql_query($sql_mo));

	$title = $rs_mo['b_subject'];
	$writer = $rs_mo['b_writerName'];
	$noticeYN = $rs_mo['b_noticeYN'];
	$contents = $rs_mo['b_contents'];}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?=$rs['siteTitle']?></title>
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
<?include "inc/top.php";?>
<div class="content-title">
    <h2><?=$rs_badmin['board_name']?></h2>
    <h4><?=$rs_badmin['board_memo']?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<h3 class="uppercase"><?=$rs_badmin['board_name']?></h3>
		</div>
		<div class="decoration"></div>
		<div class="container">
			<div class="contact-form no-bottom"> 
                <form name="writeForm" action="board/board-process.php" method="post" class="contactForm" enctype="multipart/form-data">
                    <fieldset>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField">제목</label>
							<input type="text" name="b_title" value="<? if($mode =='modify'){echo ($title);}?>" class="contactField contactNameField">
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">작성자</label>
                            <input type="text" name="b_writer" value="<? if($mode =='modify'){echo ($writer);}?>" class="contactField contactNameField">
                        </div>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField">비밀번호<?=$rs_badmin['b_secreitYN']?></label>
                            <input type="password" name="b_passWord" value="" class="contactField contactNameField">
                        </div>
<? if ($rs_badmin['secretYN']=="Y") { ?>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">비밀글 작성 여부</label>
                            <input type="radio" name="b_secretYN" id="b_secretY" value="Y" <?if($rs_mo['b_secretYN']=="Y"){ echo "checked"; }?>>&nbsp;<label for="b_secretY">비밀글</label> 
							<input type="radio" name="b_secretYN" id="b_secretN" value="N" <?if($rs_mo['b_secretYN']=="N"){ echo "checked"; }?>>&nbsp;<label for="b_secretN">공개글</label>
                        </div>
<? } ?>
						<div class="formFieldWrap">
							<label class="field-title contactNameField">내용</label>
                            <textarea name="b_content" class="contactTextarea" style="height: 100px;"><?=$contents?></textarea>
						</div>
<? if ($rs_mo['file_names'] != "") { ?>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">첨부된 파일</label>
                            <a href="board/upload_files/<?=$rs_mo['file_names']?>" target="_blank"><?=$rs_mo['file_realnames']?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<input type="checkbox" name="fileDeleteYN" value="Y"> 기존 첨부파일 삭제시 체크<input type="hidden" value="<?=$rs_mo['file_names']?>" name="nowFile">
                        </div>
<? } ?>
						<div class="formFieldWrap">
                            <label class="field-title contactNameField">파일첨부</label>
                            <input type="file" name="userFile" class="contactField contactNameField">
                        </div>
					<!--	<div class="formFieldWrap">
                            <label class="field-title contactNameField">스팸방지 (글자 클릭시 새 코드 생성)</label>
							<div class="column">
								<div class="one-half">
									<input name="zsfCode" id="zsfCode" type="text" class="contactField contactNameField" onblur="checkZsfCode(this);" maxlength="4"><input type="hidden" id="zsfCodeResult" name="zsfCodeResult">
								</div>
								<div class="one-third no-left">
									<img id="zsfImg" src="../nano/zmSpamFree/zmSpamFree.php?zsfimg&re" style="border: none; cursor: pointer; height: 30px;" onclick="this.src='../nano/zmSpamFree/zmSpamFree.php?re&amp;zsfimg='+new Date().getTime(); document.writeForm.zsfCode.value='';">
								</div>
							</div>
                        </div>-->
						<div class="decoration"></div>
						<div class="center-text">
							<a href="sub.php?npage=<?=$npage?>&ck=B&id=<?=$boardID?>&search_text=<?=$search_text?>"><span class="button btn-sm button-inverse">취소</span></a>
							<a href="javascript:checkForm();"><span class="button btn-sm button-warning">등록</span></a>
						</div>
                    </fieldset>
				<input type="hidden" name="id" value="<?=$boardID?>">
				<input type="hidden" name="type_id" value="<?=$rs_badmin['type_id']?>">
				<input type="hidden" name="b_idx" value="<?=$b_idx?>">
				<input type="hidden" name="mode" value="<?=$mode?>">
				<input type="hidden" name="ck" value="B">
				<input type="hidden" name="npage" value="<?=$npage?>">
				<input type="hidden" name="search_text" value="<?=$search_text?>">
                </form>      
            </div>
		</div>
	</div>
</div>
<?include "inc/bottom.php";?>
</body>
<script type="text/javascript">
var form = document.writeForm;

function checkForm() {
	if (form.b_title.value == "") {
		alert('제목을 입력하세요.');
		form.b_title.focus();
	} else if (form.b_writer.value == "") {
		alert('작성자를 입력하세요.');
		form.b_writer.focus();
	} else if (form.b_passWord.value.length < 4) {
		alert('비밀번호를 4자 이상 입력하세요.');
		form.b_passWord.focus();
	} else if (form.b_content.value == "") {
		alert('내용을 입력하세요.');
		form.b_content.focus();
	} else {
		if (confirm('작성하신 글을 등록하시겠습니까?')==1) {
			form.submit();
			return true;
		}
	}
}

/*
 else if (form.zsfCodeResult.value != 1 || form.zsfCode.value == "") {
		checkFrm();
	}
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
 */
</script>
</html>