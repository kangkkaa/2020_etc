<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="<?=htmlspecialchars($rs_page['siteTag'])?>">
<meta name="description" content="<?=htmlspecialchars($rs_page['siteDescription'])?>">
<title><?=$rs_page['siteTitle']?></title>
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
    <h2><?=htmlspecialchars($rs_page['pageTitle'])?></h2>
    <p><?=htmlspecialchars($rs_page['pageText'])?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
	<?=$rs_page['pagecontent']?>
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
		form.action = "view.php";
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

