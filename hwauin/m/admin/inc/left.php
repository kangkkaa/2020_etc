<? session_start(); ?>
	<div class="wrapper">
	<div class="snb-wrapper">
		<div class="logo">
			<img src="../board/upload_files/<?=$rs['siteLogo']?>" border="0" width="150">
		</div>
		<ul class="side-nav">
			<li><a href="#" class="text-danger"><i class="fa fa-spinner fa-spin"></i>&nbsp;관리자님 접속중</a>
				<ul>
					<li><a href="member-view.php?npage=1&midx=<?=$_SESSION['mobile']['admIdx']?>&mode=admin&processMode=insert&search_text="><i class="glyphicon glyphicon-user"></i>내 회원 정보</a></li>
					<li><a href="logOut.php"><i class="fa fa-sign-out"></i>로그아웃</a></li>
					<li><a href="../" target="_blank"><i class="fa fa-home"></i>홈페이지 바로가기</a></li>
				</ul>
			</li>
			<li<? if ($page == "main") { ?> class="active"<? } ?>><a href="main.php"><i class="fa fa-th-large"></i>관리 요약</a></li>
			<li<? if ($page == "contactusOrionnet") { ?> class="active"<? } ?>><a href="contactUs.php"><i class="fa fa-question-circle"></i>상담/문의 관리</a></li>
			<li><a href="#"><i class="fa fa-clipboard"></i>게시물 관리</a>
				<ul>
<? $sqlmin = "SELECT * FROM boardAdmin WHERE board_id != 'contactusOrionnet'";
	$resultmin = mysql_query($sqlmin);
	while($rsmin = mysql_fetch_array($resultmin)){
?>
					<li<? if ($page == $rsmin['board_id']) { ?> class="active"<? } ?> ><a href="board.php?npage=1&id=<?=$rsmin['board_id']?>"><i class="fa fa-file-text-o"></i><?=$rsmin['board_name']?></a></li>
<? } ?>

				</ul>
			</li>
			<li><a href="#"><i class="fa fa-user"></i>회원 관리</a>
				<ul>
					<!-- <li><a href="member.php?mode=custom"><i class="fa fa-smile-o"></i>일반회원 관리</a></li> -->
					<li<? if ($page == "admin") { ?> class="active"<? } ?>><a href="member.php?mode=admin"><i class="fa fa-key"></i>관리회원 관리</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-cogs"></i>기본 설정</a>
				<ul>
					<li <? if ($page == "baseConfig") { ?> class="active"<? } ?>><a href="baseConfig.php"><i class="fa fa-info-circle"></i>사이트 정보 관리</a></li>
					<li <? if ($page == "logo") { ?> class="active"<? } ?>><a href="logoAdmin.php"><i class="fa fa-tag"></i>사이트 로고 관리</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-tablet"></i>디자인 및 환경 설정</a>
				<ul>
					<li <? if ($page == "mainPage") { ?> class="active"<? } ?>><a href="mainPage.php"><i class="fa fa-list-ol"></i>메인페이지 설정</a></li>
					<li<? if ($page == "mainSlider") { ?> class="active"<? } ?>><a href="mainSlider.php"><i class="fa fa-picture-o"></i>메인이미지 슬라이드 설정</a></li>
					<li<? if ($page == "menuConfig") { ?> class="active"<? } ?>><a href="menuConfig.php"><i class="fa fa-sitemap"></i>사이트 메뉴 설정</a></li>
					<li<? if ($page == "boardConfig") { ?> class="active"<? } ?>><a href="boardConfig.php"><i class="fa fa-list-alt"></i>게시판 설정</a></li>
					<li<? if ($page == "pageConfig") { ?> class="active"<? } ?>><a href="pageConfig.php"><i class="fa fa-pencil-square-o"></i>페이지내용 설정</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-bar-chart-o"></i>통계/로그 분석</a>
				<ul>
					<li<? if ($page == "logConfig") { ?> class="active"<? } ?>><a href="logConfig.php"><i class="fa fa-signal"></i>구글 애널리틱스 설정</a></li>
					<li><a href="https://www.google.com/intl/ko/analytics/" target="_blank"><i class="fa fa-google-plus"></i>구글 애널리틱스 바로가기</a></li>
				</ul>
			</li>
			<li<? if ($page == "syndication") { ?> class="active"<? } ?>><a href="ping.php"><i class="fa fa fa-cog"></i>신디케이션</a></li>
			<li<? if ($page == "popupAdmin") { ?> class="active"<? } ?>><a href="popupAdmin.php"><i class="fa fa-folder-open"></i>레이어팝업 관리</a></li>
			<li><a href="javascript:alert('준비중입니다.');"><i class="fa fa-folder-open"></i>사용설명 도움말</a></li>
			<li class="divider"></li>
		</ul>
<?
$sql2 ="select count(*) total_count from m_member where mem_level=1";
$rs2 = mysql_fetch_array(mysql_query($sql2));
$recordcounT = $rs2['total_count'];

$sql3 ="select count(*) total_count from boardTable where board_id='contactusOrionnet'";
$rs3 = mysql_fetch_array(mysql_query($sql3));
$recordcount2 = $rs3['total_count'];
?>
		<div class="list-group">
			<span class="list-group-item active"><i class="fa fa-tasks"></i>&nbsp;&nbsp;서비스 정보</span>
			<span class="list-group-item">관리자<span class="pull-right text-pink strong"><?=$recordcounT?></span></span>
			<span class="list-group-item">상담/문의글<span class="pull-right text-pink strong"><?=$recordcount2?></span></span>
		</div>
	</div>	