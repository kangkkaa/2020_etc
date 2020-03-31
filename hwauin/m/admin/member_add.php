<? include "../inc/link.php"; 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<script type="text/javascript" language="javascript" src="js/common.js"></script>
</head>
<body id="admin-wrapper" class="stretched">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$midx = $_GET['midx'];
$mode = $_GET['mode'];
$processMode = $_GET['processMode'];
$npage = $_GET['npage'];
$search_text = $_GET['search_text'];

if($processMode =="modify"){
	$sql_mem = "SELECT * FROM m_member WHERE idx=".$midx;
	$rs_mem = mysql_fetch_array(mysql_query($sql_mem));

	if($rs_mem['mem_status']=="Y"){
		$status = "";
	}else if($rs_mem['mem_status']=='N'){
		$status = "";
	}
	unset($sql_mem);
	$pwd = "본 회원의 암호 변경시에만 입력";
	$url = "member-view.php?midx=".$midx."&mode=".$mode."&npage=".$npage."&search_text=".$search_text;
}else if($processMode =="insert"){
	$pwd = "6자리 이상 영문, 숫자만";
	$url = "member.php?mode=".$mode."&npage=".$npage."&search_text=".$search_text;
}

$page = "admin";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">관리회원 관리</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;회원 등록/수정하기</div>
						<div class="panel-body">
							<form name="addForm" method="post" action="memberProcess.php" class="form-horizontal">
							<input type="hidden" name="midx" value="<?=$midx?>">
							<input type="hidden" name="mode" value="<?=$mode?>">
							<input type="hidden" name="processMode" value="<?=$processMode?>">
							<input type="hidden" name="npage" value="<?=$npage?>">
							<input type="hidden" name="search_text" value="<?=$search_text?>">
							<input type="hidden" value="" name="accountid_chk">
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;아이디</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin norightmargin">
											<input type="text" class="form-control" placeholder="" name="mem_id" onchange="id_change();" value="<?=$rs_mem['mem_id']?>" required <?if($processMode=="modify"){echo ("readonly");}?>>
										</div>
<? if($processMode=="insert"){?>
										<div class="col-one-third col-last nobottommargin">
											<button class="button button-inverse btn-sm" type="button" onclick="member_chk();">중복확인</button>
										</div>
<? } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;비밀번호</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin">
											<input type="password" class="form-control" placeholder="<?=$pwd?>" name="mem_pw" >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;비밀번호 확인</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin">
											<input type="password" class="form-control" placeholder="암호 재확인" name="mem_pw2">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;이름/닉네임</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin norightmargin">
											<input type="text" class="form-control" placeholder="" name="mem_name" value="<?=$rs_mem['mem_name']?>" >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;이메일</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin norightmargin">
											<input type="email" class="form-control" placeholder="" name="mem_email" value="<?=$rs_mem['mem_email']?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;연락처</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin norightmargin">
											<input type="email" class="form-control" placeholder="" name="mem_tel" value="<?=$rs_mem['mem_tel']?>" required>
										</div>
									</div>
								</div>
<? if($processMode=="modify"){?>
								<div class="form-group">
									<label class="col-one-sixth control-label"><i class="fa fa-check-square text-default"></i>&nbsp;&nbsp;가입/탈퇴</label>
									<div class="col-five-sixth col-last nobottommargin">
										<div class="col-one-third nobottommargin norightmargin">
											<div class="radio">
												<label><input type="radio" name="mem_status" value="Y" <?if($rs_mem['mem_status']=="Y"){echo("checked");}?>>&nbsp;<span class='label label-info'>정상</span></label>&nbsp;&nbsp;&nbsp;
											</div>
											<div class="radio">
												<label><input type="radio" name="mem_status" value="N" <?if($rs_mem['mem_status']=="N"){echo("checked");}?>>&nbsp;<span class='label label-danger'>탈퇴</span></label>
											</div>
										</div>
									</div>
								</div>
<? } ?>
							</form>
						</div>
						<div class="panel-footer text-center">
							<a href="<?=$url?>"><span class="button button-inverse btn-sm"><i class="fa fa-times"></i>&nbsp;취소</span></a>
							<button type="button" class="button button-default btn-sm" onclick="checkForm();"><i class="fa fa-check"></i>&nbsp;확인</button>
						</div>
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
var form = document.addForm;
<? if($processMode=="insert"){?>

function member_chk() {
	var frm_string = $("form[name=addForm]").serialize();
	$.ajax({
		type: "POST",
		url: "check_id.php",
		data: frm_string,
		success: function(data) {
			if (data == "noinput") {
				alert('회원 아이디를 입력해주세요.');
				form.mem_id.focus();
			} else if (data == "memnotok") {
				alert('중복된 회원 아이디입니다. 다른 아이디를 사용해주세요.');
				form.mem_id.value = "";
				form.mem_id.focus();
			} else if (data == "memok") {
				alert('사용가능한 회원 아이디입니다.');
				form.accountid_chk.value = "Y";
			}
		},
		error: function(msg) {
			alert('중복확인에 실패하였습니다. Error: '+msg);
		}
	});
}

<? } ?>
function id_change() {
	form.accountid_chk.value = "N";
}

<? if($processMode=="insert"){?>

function checkForm() {
	if (form.mem_name.value == "") {
		alert('회원 이름을 입력해주세요.');
		form.mem_name.focus();
	} else if (!isValidEmail(form.mem_email.value)) {
		form.mem_email.focus();
	} else if (check_alphanumber(form.mem_id.value) == false) {
		alert('아이디는 영문소문자, 숫자만 입력가능합니다.');
		form.mem_id.focus();
	} else if (form.mem_id.value.length < 4 || form.mem_id.value.length > 16) {
		alert('아이디는 4~16자까지 입력해주세요.');
		form.mem_id.focus();
	} else if (form.mem_id.value.indexOf(" ") >= 0) {
		alert('아이디에 공백을 사용할 수 없습니다.');
		form.mem_id.focus();
	} else if (form.mem_pw.value == "") {
		alert('암호를 입력해주세요.');
		form.mem_pw.focus();
	} else if (form.accountid_chk.value != "Y") {
		alert('아이디 중복검사를 해주세요.');
		form.mem_id.focus();
	} else if (form.mem_pw.value.length > 0 && form.mem_pw.value.length < 6) {
		alert('암호를 6자 이상 입력해주세요.');
		form.mem_pw.focus();
	} else if (form.mem_pw.value != form.mem_pw2.value) {
		alert('암호 재확인이 일치하지 않습니다.');
		form.mem_pw2.focus();
	} else if (form.mem_tel.value == "") {
		alert('회원 연락처를 입력해주세요.');
		form.mem_tel.focus();
	} else {
		if (confirm('회원 정보를 등록 또는 수정하시겠습니까?')==1) {
			form.search_text.value = encodeURI(form.search_text.value);
			form.submit();
			return true;
		}
	}
}
<? } else if($processMode=="modify"){?>
function checkForm() {
	if (form.mem_name.value == "") {
		alert('회원 이름을 입력해주세요.');
		form.mem_name.focus();
	} else if (!isValidEmail(form.mem_email.value)) {
		form.mem_email.focus();
	} else if (form.mem_pw.value.length > 0 && form.mem_pw.value.length < 6) {
		alert('암호를 6자 이상 입력해주세요.');
		form.mem_pw.focus();
	} else if (form.mem_pw.value != form.mem_pw2.value) {
		alert('암호 재확인이 일치하지 않습니다.');
		form.mem_pw2.focus();
	} else if (form.mem_tel.value == "") {
		alert('회원 연락처를 입력해주세요.');
		form.mem_tel.focus();
	} else {
		if (confirm('회원 정보를 등록 또는 수정하시겠습니까?')==1) {
			form.search_text.value = encodeURI(form.search_text.value);
			form.submit();
			return true;
		}
	}
}
<? } ?>
</script>
</html>