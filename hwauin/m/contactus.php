<? include "inc/link.php"; ?>
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$boardID = "contactusOrionnet";	

$sql_badmin = "SELECT * FROM boardAdmin WHERE board_id='".$boardID."' AND status='Y'";
$result_badmin = mysql_query($sql_badmin) or die(mysql_error());
$rs_badmin = mysql_fetch_array($result_badmin);

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="호스팅, 홈페이지제작">
<meta name="description" content="미리내닷컴에서 호스팅 서비스를 이용하시면 쉽고 편한 무료 홈페이지 솔루션을 제공합니다.">
<title><?=htmlspecialchars($rs_badmin['siteTitle'])?></title>
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
<script type="text/javascript" language="javascript" src="js/common.js"></script>
</head>
<body>
<? include "inc/top.php"; ?>
<div class="content-title">
	<h2><?=htmlspecialchars($rs_badmin['board_name'])?></h2>
    <p><?=htmlspecialchars($rs_badmin['board_memo'])?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<h3>접수 항목 작성</h3>
		</div>
		<div class="container">
            <div class="contact-form no-bottom"> 
                <form name="contactForm" action="contactProcess.php" method="post" class="contactForm">
                    <fieldset>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField">이름 또는 회사명</label>
                            <input type="text" name="c_name" value="" class="contactField contactNameField">
                        </div>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField">연락처</label>
                            <input type="text" name="c_mobile" value="" class="contactField contactNameField">
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactEmailField">이메일</label>
                            <input type="text" name="c_mail" value="" class="contactField requiredEmailField">
                        </div>
						<div class="formFieldWrap">
                            <label class="field-title contactEmailField">상담 제목</label>
                            <input type="text" name="c_subject" value="" class="contactField requiredEmailField">
                        </div>
                        <div class="formTextareaWrap half-bottom">
                            <label class="field-title contactMessageTextarea">상담 내용</label>
                            <textarea name="contactMessage" class="contactTextarea requiredField no-bottom"></textarea>
                        </div>
						<div class="half-bottom">
							<a href="#" onclick="validForm();" class="float-right"><span class="button btn-sm button-inverse">문의하기</span></a>
						</div>
                    </fieldset>
                </form>       
            </div>
        </div> 
	</div>
</div>
<? include "inc/bottom.php"; ?>
</body>
<script type="text/javascript">
form = document.contactForm;

function validForm() {
	if (form.c_name.value == "") {
		alert('이름 또는 회사명을 입력해주세요.');
		form.c_name.focus();
		return false;
	} else if (form.c_mobile.value == "") {
		alert('연락처를 입력해주세요.');
		form.c_mobile.focus();
		return false;
	} else if (!isValidEmail(form.c_mail.value)) {
		form.c_mail.focus();
		return false;
	} else if (form.c_subject.value == "") {
		alert('제목을 입력해주세요.');
		form.c_subject.focus();
		return false;
	} else if (form.contactMessage.value == "") {
		alert('내용을 입력해주세요.');
		form.contactMessage.focus();
		return false;
	} else {
		if (confirm('문의사항을 접수하시겠습니까?')==1) {
			form.submit();
			return true;
		}
	}
}
</script>

</html>

