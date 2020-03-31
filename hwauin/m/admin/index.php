<? include "../inc/link.php" ?>
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<head>
<title><?=$rs['siteTitle']?></title>
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
<script type="text/javascript" language="javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="dist/js/bootstrap.js"></script>
</head>
<?
if(isset($_SESSION['mobile']['admIdx'])){
	Error("이미 로그인 하셨습니다.", 'main.php');
}
?>
<body class="light">
	<div id="wrapper">
		<div class="login-wrapper">
			<div class="container">
				<div class="logo"><img src="../board/upload_files/<?=$rs['siteLogo']?>"></div>
				<h6 class="opensans title halfbottom">Administrator login</h6>
<form name="loginForm" id="loginForm" onsubmit="loginCheck(); return false;">
					<div class="input-group halfbottom">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="adminID" placeholder="아이디">
					</div>
					<div class="input-group halfbottom">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input type="password" class="form-control" name="adminPW" placeholder="비밀번호">
					</div>
					<div class="text-right">
						<button type="submit" class="button button-default"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
					</div>
</form>
			</div>
			<div class="footer">&copy; 2013 Orionnet.kr All Rights Reserved</div>
		</div>
	</div>
</body>
<script type="text/javascript">
function loginCheck() {
	var frm_string = $("form[name=loginForm]").serialize();
	$.ajax({
		type: "POST",
		url: "loginOk.php",
		data: frm_string,
		success: function(data) {
			if (data == "noinput") {
				alert('필수 입력 정보가 비었습니다. 다시 확인해 주세요.');
			} else if (data == "nomember") {
				alert('등록된 관리자 정보가 없습니다. 다시 확인해 주세요.');
			} else if (data == "nopwd") {
				alert('관리 암호가 틀렸습니다. 다시 확인해 주세요.');
				document.loginForm.adminPW.value = "";
				document.loginForm.adminPW.focus();
			} else if (data == "success") {
				location.href = "main.php";
			}
		},
		error: function(msg) {
			alert('로그인에 실패하였습니다. Error: '+msg);
		}
	});
}
</script>
</html>