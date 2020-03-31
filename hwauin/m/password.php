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
$c_idx = $_GET['c_idx'];
$search_text = $_GET['search_text'];

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
<title><?=iconv("euc-kr","utf-8",htmlspecialchars($rs['siteTitle']))?></title>
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
<? include "inc/top.php"; ?>
<div class="content-title">
	<h2><?=$rs_badmin['board_name']?></h2>
    <p><?=$rs_badmin['board_memo']?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<h3>글 비밀번호 입력</h3>
		</div>
		<div class="container no-bottom">
            <div class="contact-form no-bottom"> 
                <form name="passForm" action="pwProcess.php" method="post" class="contactForm">
				<input type="hidden" name="id" value="<?=$boardID?>">
				<input type="hidden" name="npage" value="<?=$npage?>">
				<input type="hidden" name="b_idx" value="<?=$b_idx?>">
				<input type="hidden" name="c_idx" value="<?=$c_idx?>">
				<input type="hidden" name="ck" value="B">
				<input type="hidden" name="mode" value="<?=$mode?>">
				<input type="hidden" name="search_text" value="<?=$search_text?>">
				<input type="hidden" name="nowFile" value="<?=$_GET['nowFile']?>">
                    <fieldset>
                        <div class="formFieldWrap">
                            <label class="field-title contactNameField">글 작성시 입력했던 <font class="text-danger">비밀번호</font>를 입력하세요.</label>
                            <input type="password" name="pwd" value="" class="contactField contactNameField">
                        </div>
						<div class="full-bottom center-text">
							<a href="#" onclick="validForm();"><span class="button btn-sm button-inverse">입력 완료</span></a>
						</div>
                    </fieldset>
                </form>       
            </div>
        </div> 
	</div>
</div>
<?include "inc/bottom.php";?>
</body>
<script type="text/javascript">
form = document.passForm;

function validForm() {
	if (form.pwd.value.length < 4) {
		alert('비밀번호를 4자 이상 입력해주세요.');
		form.pwd.focus();
		return false;
	} else {
		form.submit();
		return true;
	}
}
</script>

</html>

