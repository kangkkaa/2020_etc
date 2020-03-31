<? include_once "_link.php";?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="<?=$rs_badmin['siteTag']?>">
<meta name="description" content="<?=$rs_badmin['siteDescription']?>">
<title><?=$rs_badmin['siteTitle']?></title>
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
    <h2>자유게시판</h2>
    <p>자유롭게 글을 쓰세요.</h4>
</div>
<div class="content">
	<div class="column no-bottom">
		
		<div class="container half-bottom">
			<form name="searchForm" id="searchForm" action="?" method="get">
			<input type="hidden" name="id" value="free">
			<input type="hidden" name="npage" value="1">
			<input type="hidden" name="b_idx" value="">
			<input type="hidden" name="ck" value="B">
			<input type="hidden" name="mode" value="list">
				<div class="column">
					<div class="two-third"><input type="text" name="search_text" placeholder="제목,내용,작성자 통합검색" value="" class="contactField"></div>
					<div class="one-third no-left"><a href="#" onclick="goSearch();"><span class="button btn-sm button-inverse"><i class="fa fa-search"></i>&nbsp;검색</span></a></div>
				</div>
			</form>
		</div>
		<div class="container no-bottom">
			<table>
				<thead>
					<tr>
						<th width="65%" class="text-primary">제목</th>
						<th width="35%" class="text-primary">작성일</th>
					</tr>
				</thead>
				<tbody>
					<tr class="bg-light-notice">
						<td><i class="fa fa-bullhorn"></i> <a href="javascript:goView(43, 'N');">공지글 테스트입니다. </a></td>
						<td class="center-text">2014.01.15</td>
					</tr>
					<tr class="bg-light-notice">
						<td><i class="fa fa-bullhorn"></i> <a href="javascript:goView(22, 'N');">qwe </a></td>
						<td class="center-text">2014.01.09</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(51, 'N');">네이버 신디케이션 연동 </a></td>
						<td class="center-text">2014.02.24</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(50, 'N');">소치동계 올림픽 폐막 </a></td>
						<td class="center-text">2014.02.24</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(49, 'N');">고마워. 연아야! </a></td>
						<td class="center-text">2014.02.21</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(48, 'N');">고마워. 연아야! </a></td>
						<td class="center-text">2014.02.21</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(47, 'N');">미리내 호스팅 서비스를 소개합니다. </a></td>
						<td class="center-text">2014.02.21</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(46, 'N');">미리내닷컴 자유게시판에 글을 올립니다. </a></td>
						<td class="center-text">2014.02.21</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(45, 'N');">마더의 김혜자. 그녀는 최고의 배우이다. </a></td>
						<td class="center-text">2014.02.20</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(42, 'N');">test </a></td>
						<td class="center-text">2014.01.13</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(41, 'N');">가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다가나다 </a></td>
						<td class="center-text">2014.01.13</td>
					</tr>
					<tr>
						<td><a href="javascript:goView(40, 'N');">testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest </a></td>
						<td class="center-text">2014.01.13</td>
					</tr>
				</tbody>
			</table>
        </div>
		<div class="container center-text">
<script language="JavaScript">
function goPage(npage) {
	form = document.searchForm;
	form.search_text.value = encodeURI(form.search_text.value);
	form.npage.value = npage;
	form.submit();
}
</script>
			<a href="#"><span class="button btn-mini button-inverse"><i class="fa fa-caret-left"></i></span></a>
			<a href="#"><span class="button btn-mini button-warning">1</span></a>
			<a href="javascript:goPage(2);"><span class="button btn-mini button-warning">2</span></a>
			<a href="javascript:goPage(2);"><span class="button btn-mini button-inverse"><i class="fa fa-caret-right"></i></span></a>
        </div>
		<div class="container right-text">
			<a href="javascript:goWrite();"><span class="button btn-sm button-inverse">글쓰기</span></a>
		</div>
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