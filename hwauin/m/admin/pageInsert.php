<? include "../inc/link.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if (!$_SESSION['mobile']['admIdx'] || $_SESSION['mobile']['admLevel'] != '1') {
	Error('로그인한 관리자만 접근 가능합니다.', 'index.php');
}
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$mode = $_GET['mode'];
$pidx = $_GET['pidx'];

if($mode=="modify"){
	$sqlP = "SELECT * FROM pageTable WHERE idx='".$pidx."'";
	$rsp = mysql_fetch_array(mysql_query($sqlP));
	$b_contents_input = htmlspecialchars($rsp['pagecontent']);
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
<link rel="stylesheet" href="../board/daumeditor/css/editor.css" type="text/css" charset="utf-8">
<script src="../board/daumeditor/js/editor_loader.js?environment=development" type="text/javascript" charset="utf-8"></script>
</head>
<body id="admin-wrapper" class="stretched">
<?
$page = "pageConfig";
include "inc/left.php"; ?>
	<div class="content-wrapper">
			<div class="container">
				<h3 class="title">페이지 내용 설정</h3>
				<div class="col-full topmargin">
					<div class="panel panel-inverse">
						<div class="panel-heading"><i class="fa fa-cog"></i>&nbsp;&nbsp;컨텐츠 페이지 등록/수정하기</div>
						<div class="panel-body">
							<form name="tx_editor_form" id="tx_editor_form" method="post" accept-charset="utf-8">
								<div class="col-full halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;제목 (해당 컨텐츠 페이지 상단에 노출되는 제목입니다.)</label>
									<input type="text" class="form-control" placeholder="페이지 제목을 입력해주세요. 본 제목은 해당 페이지에 노출됩니다." name="p_subject" value="<?=$rsp['pageTitle']?>">
								</div>
								<div class="col-full halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;설명 (해당 컨텐츠 페이지 상단 제목 아래에 노출되는 간단한 설명입니다.)</label>
									<input type="text" class="form-control" placeholder="페이지 설명을 입력해주세요. 본 설명은 해당 페이지에 노출됩니다." name="p_memo" value="<?=$rsp['pageText']?>">
								</div>
								<div class="col-full halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;페이지 타이틀 (타이틀은 인터넷 브라우저 상단에 표시됩니다. 페이지의 제목, 이름의 성격으로 검색에도 중요한 부분을 차지합니다.)</label>
									<input type="text" class="form-control" name="p_title" value="<?=$rsp['siteTitle']?>">
								</div>
								<div class="col-full halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;페이지 태그 (페이지의 주요 키워드 및 태그를 입력하실 수 있습니다. 키워드 구분은 콤마(,)로 구분하십시요.)</label>
									<input type="text" class="form-control"  placeholder="ex) 오리온네트웍스, 홈페이지 제작, 바이럴 마케팅" name="p_key" value="<?=$rsp['siteTag']?>">
								</div>
								<div class="col-full halfbottom">
									<label class="text-default"><i class="fa fa-check-square"></i>&nbsp;페이지 설명 (페이지에 대한 간략한 설명을 입력하실 수 있습니다. 페이지의 요약된 핵심 설명을 서술형으로 기술하십시요.)</label>
									<input type="text" class="form-control" placeholder="ex) 홈페이지제작과마케팅을 한번에?! 오리온네트웍스가 당신의 홈페이지에 날개를 달아드리겠습니다." name="p_de" value="<?=$rsp['siteDescription']?>">
								</div>
								<div class="col-full halfbottom">
<!-- 다음 에디터 시작-->
<div id="tx_trex_container" class="tx-editor-container">
	<div id="tx_sidebar" class="tx-sidebar">
		<div class="tx-sidebar-boundary">
			<ul class="tx-bar tx-bar-left tx-nav-attach">
				<li class="tx-list">
					<div unselectable="on" id="tx_image" class="tx-image tx-btn-trans">
						<a href="javascript:;" title="사진" class="tx-text">사진</a>
					</div>
				</li>
				<li class="tx-list">
					<div unselectable="on" id="tx_file" class="tx-file tx-btn-trans">
						<a href="javascript:;" title="파일" class="tx-text">파일</a>
					</div>
				</li>
				<li class="tx-list">
					<div unselectable="on" id="tx_media" class="tx-media tx-btn-trans">
						<a href="javascript:;" title="외부컨텐츠" class="tx-text">외부컨텐츠</a>
					</div>
				</li>
				<li class="tx-list tx-list-extra">
					<div unselectable="on" class="tx-btn-nlrbg tx-extra">
						<a href="javascript:;" class="tx-icon" title="버튼 더보기">버튼 더보기</a>
					</div>
					<ul class="tx-extra-menu tx-menu" style="left:-48px;" unselectable="on"></ul>
				</li>
			</ul>
			<ul class="tx-bar tx-bar-right">
				<li class="tx-list">
					<div unselectable="on" class="tx-btn-lrbg tx-fullscreen" id="tx_fullscreen">
						<a href="javascript:;" class="tx-icon" title="넓게쓰기 (Ctrl+M)">넓게쓰기</a>
					</div>
				</li>
			</ul>
			<ul class="tx-bar tx-bar-right tx-nav-opt">
				<li class="tx-list">
					<div unselectable="on" class="tx-switchtoggle" id="tx_switchertoggle">
						<a href="javascript:;" title="에디터 타입">에디터</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div id="tx_toolbar_basic" class="tx-toolbar tx-toolbar-basic"><div class="tx-toolbar-boundary">
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div id="tx_fontfamily" unselectable="on" class="tx-slt-70bg tx-fontfamily">
					<a href="javascript:;" title="글꼴">맑은 고딕</a>
				</div>
				<div id="tx_fontfamily_menu" class="tx-fontfamily-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div unselectable="on" class="tx-slt-42bg tx-fontsize" id="tx_fontsize">
					<a href="javascript:;" title="글자크기">9pt</a>
				</div>
				<div id="tx_fontsize_menu" class="tx-fontsize-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-font">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-bold" id="tx_bold">
					<a href="javascript:;" class="tx-icon" title="굵게 (Ctrl+B)">굵게</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-underline" id="tx_underline">
					<a href="javascript:;" class="tx-icon" title="밑줄 (Ctrl+U)">밑줄</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-italic" id="tx_italic">
					<a href="javascript:;" class="tx-icon" title="기울임 (Ctrl+I)">기울임</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-strike" id="tx_strike">
					<a href="javascript:;" class="tx-icon" title="취소선 (Ctrl+D)">취소선</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-slt-tbg tx-forecolor" id="tx_forecolor">
					<a href="javascript:;" class="tx-icon" title="글자색">글자색</a>
					<a href="javascript:;" class="tx-arrow" title="글자색 선택">글자색 선택</a>
				</div>
				<div id="tx_forecolor_menu" class="tx-menu tx-forecolor-menu tx-colorpallete" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-slt-brbg tx-backcolor" id="tx_backcolor">
					<a href="javascript:;" class="tx-icon" title="글자 배경색">글자 배경색</a>
					<a href="javascript:;" class="tx-arrow" title="글자 배경색 선택">글자 배경색 선택</a>
				</div>
				<div id="tx_backcolor_menu" class="tx-menu tx-backcolor-menu tx-colorpallete" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-align">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-alignleft" id="tx_alignleft">
					<a href="javascript:;" class="tx-icon" title="왼쪽정렬 (Ctrl+,)">왼쪽정렬</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-aligncenter" id="tx_aligncenter">
					<a href="javascript:;" class="tx-icon" title="가운데정렬 (Ctrl+.)">가운데정렬</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-alignright" id="tx_alignright">
					<a href="javascript:;" class="tx-icon" title="오른쪽정렬 (Ctrl+/)">오른쪽정렬</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-alignfull" id="tx_alignfull">
					<a href="javascript:;" class="tx-icon" title="양쪽정렬">양쪽정렬</a>
				</div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-tab">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-indent" id="tx_indent">
					<a href="javascript:;" title="들여쓰기 (Tab)" class="tx-icon">들여쓰기</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-outdent" id="tx_outdent">
					<a href="javascript:;" title="내어쓰기 (Shift+Tab)" class="tx-icon">내어쓰기</a>
				</div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-list">
			<li class="tx-list">
				<div unselectable="on" class="tx-slt-31lbg tx-lineheight" id="tx_lineheight">
					<a href="javascript:;" class="tx-icon" title="줄간격">줄간격</a>
					<a href="javascript:;" class="tx-arrow" title="줄간격">줄간격 선택</a>
				</div>
				<div id="tx_lineheight_menu" class="tx-lineheight-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-slt-31rbg tx-styledlist" id="tx_styledlist">
					<a href="javascript:;" class="tx-icon" title="리스트">리스트</a>
					<a href="javascript:;" class="tx-arrow" title="리스트">리스트 선택</a>
				</div>
				<div id="tx_styledlist_menu" class="tx-styledlist-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-etc">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-emoticon" id="tx_emoticon">
					<a href="javascript:;" class="tx-icon" title="이모티콘">이모티콘</a>
				</div>
				<div id="tx_emoticon_menu" class="tx-emoticon-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-link" id="tx_link">
					<a href="javascript:;" class="tx-icon" title="링크 (Ctrl+K)">링크</a>
				</div>
				<div id="tx_link_menu" class="tx-link-menu tx-menu"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-specialchar" id="tx_specialchar">
					<a href="javascript:;" class="tx-icon" title="특수문자">특수문자</a>
				</div>
				<div id="tx_specialchar_menu" class="tx-specialchar-menu tx-menu"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-table" id="tx_table">
					<a href="javascript:;" class="tx-icon" title="표만들기">표만들기</a>
				</div>
				<div id="tx_table_menu" class="tx-table-menu tx-menu" unselectable="on">
					<div class="tx-menu-inner">
						<div class="tx-menu-preview"></div>
						<div class="tx-menu-rowcol"></div>
						<div class="tx-menu-deco"></div>
						<div class="tx-menu-enter"></div>
					</div>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-horizontalrule" id="tx_horizontalrule">
					<a href="javascript:;" class="tx-icon" title="구분선">구분선</a>
				</div>
				<div id="tx_horizontalrule_menu" class="tx-horizontalrule-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-richtextbox" id="tx_richtextbox">
					<a href="javascript:;" class="tx-icon" title="글상자">글상자</a>
				</div>
				<div id="tx_richtextbox_menu" class="tx-richtextbox-menu tx-menu">
					<div class="tx-menu-header">
						<div class="tx-menu-preview-area">
							<div class="tx-menu-preview"></div>
						</div>
						<div class="tx-menu-switch">
							<div class="tx-menu-simple tx-selected"><a><span>간단 선택</span></a></div>
							<div class="tx-menu-advanced"><a><span>직접 선택</span></a></div>
						</div>
					</div>
					<div class="tx-menu-inner"></div>
					<div class="tx-menu-footer">
						<img class="tx-menu-confirm" src="../board/daumeditor/images/icon/editor/btn_confirm.gif?rv=1.0.1" alt="">
						<img class="tx-menu-cancel" hspace="3" src="../board/daumeditor/images/icon/editor/btn_cancel.gif?rv=1.0.1" alt="">
					</div>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-quote" id="tx_quote">
					<a href="javascript:;" class="tx-icon" title="인용구 (Ctrl+Q)">인용구</a>
				</div>
				<div id="tx_quote_menu" class="tx-quote-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-background" id="tx_background">
					<a href="javascript:;" class="tx-icon" title="배경색">배경색</a>
				</div>
				<div id="tx_background_menu" class="tx-menu tx-background-menu tx-colorpallete" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-undo">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-undo" id="tx_undo">
					<a href="javascript:;" class="tx-icon" title="실행취소 (Ctrl+Z)">실행취소</a>
				</div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-redo" id="tx_redo">
					<a href="javascript:;" class="tx-icon" title="다시실행 (Ctrl+Y)">다시실행</a>
				</div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-right">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-nlrbg tx-advanced" id="tx_advanced">
					<a href="javascript:;" class="tx-icon" title="툴바 더보기">툴바 더보기</a>
				</div>
			</li>
		</ul>
	</div>
</div>
<div id="tx_toolbar_advanced" class="tx-toolbar tx-toolbar-advanced">
	<div class="tx-toolbar-boundary">
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div class="tx-tableedit-title"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-align">
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-lbg tx-mergecells" id="tx_mergecells">
					<a href="javascript:;" class="tx-icon2" title="병합">병합</a>
				</div>
				<div id="tx_mergecells_menu" class="tx-mergecells-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-bg tx-insertcells" id="tx_insertcells">
					<a href="javascript:;" class="tx-icon2" title="삽입">삽입</a>
				</div>
				<div id="tx_insertcells_menu" class="tx-insertcells-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div unselectable="on" class="tx-btn-rbg tx-deletecells" id="tx_deletecells">
					<a href="javascript:;" class="tx-icon2" title="삭제">삭제</a>
				</div>
				<div id="tx_deletecells_menu" class="tx-deletecells-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left tx-group-align">
			<li class="tx-list">
				<div id="tx_cellslinepreview" unselectable="on" class="tx-slt-70lbg tx-cellslinepreview">
					<a href="javascript:;" title="선 미리보기"></a>
				</div>
				<div id="tx_cellslinepreview_menu" class="tx-cellslinepreview-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div id="tx_cellslinecolor" unselectable="on" class="tx-slt-tbg tx-cellslinecolor">
					<a href="javascript:;" class="tx-icon2" title="선색">선색</a>

					<div class="tx-colorpallete" unselectable="on"></div>
				</div>
				<div id="tx_cellslinecolor_menu" class="tx-cellslinecolor-menu tx-menu tx-colorpallete" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div id="tx_cellslineheight" unselectable="on" class="tx-btn-bg tx-cellslineheight">
					<a href="javascript:;" class="tx-icon2" title="두께">두께</a>
				</div>
				<div id="tx_cellslineheight_menu" class="tx-cellslineheight-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div id="tx_cellslinestyle" unselectable="on" class="tx-btn-bg tx-cellslinestyle">
					<a href="javascript:;" class="tx-icon2" title="스타일">스타일</a>
				</div>
				<div id="tx_cellslinestyle_menu" class="tx-cellslinestyle-menu tx-menu" unselectable="on"></div>
			</li>
			<li class="tx-list">
				<div id="tx_cellsoutline" unselectable="on" class="tx-btn-rbg tx-cellsoutline">
					<a href="javascript:;" class="tx-icon2" title="테두리">테두리</a>
				</div>
				<div id="tx_cellsoutline_menu" class="tx-cellsoutline-menu tx-menu" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div id="tx_tablebackcolor" unselectable="on" class="tx-btn-lrbg tx-tablebackcolor" style="background-color:#9aa5ea;">
					<a href="javascript:;" class="tx-icon2" title="테이블 배경색">테이블 배경색</a>
				</div>
				<div id="tx_tablebackcolor_menu" class="tx-tablebackcolor-menu tx-menu tx-colorpallete" unselectable="on"></div>
			</li>
		</ul>
		<ul class="tx-bar tx-bar-left">
			<li class="tx-list">
				<div id="tx_tabletemplate" unselectable="on" class="tx-btn-lrbg tx-tabletemplate">
					<a href="javascript:;" class="tx-icon2" title="테이블 서식">테이블 서식</a>
				</div>
				<div id="tx_tabletemplate_menu" class="tx-tabletemplate-menu tx-menu tx-colorpallete" unselectable="on"></div>
			</li>
		</ul>
	</div>
</div>
<div id="tx_canvas" class="tx-canvas">
	<div id="tx_loading" class="tx-loading">
		<div><img src="../board/daumeditor/images/icon/editor/loading2.png" width="113" height="21" align="absmiddle"></div>
	</div>
	<div id="tx_canvas_wysiwyg_holder" class="tx-holder" style="display:block;">
		<iframe id="tx_canvas_wysiwyg" name="tx_canvas_wysiwyg" allowtransparency="true" frameborder="0"></iframe>
	</div>
	<div class="tx-source-deco">
		<div id="tx_canvas_source_holder" class="tx-holder">
			<textarea id="tx_canvas_source" rows="30" cols="30"></textarea>
		</div>
	</div>
	<div id="tx_canvas_text_holder" class="tx-holder">
		<textarea id="tx_canvas_text" rows="30" cols="30"></textarea>
	</div>
</div>
<div id="tx_resizer" class="tx-resize-bar">
	<div class="tx-resize-bar-bg"></div>
	<img id="tx_resize_holder" src="../board/daumeditor/images/icon/editor/skin/01/btn_drag01.gif" width="58" height="12" unselectable="on" alt="">
</div>

<div id="tx_attach_div" class="tx-attach-div">
	<div id="tx_attach_txt" class="tx-attach-txt">파일 첨부</div>
	<div id="tx_attach_box" class="tx-attach-box">
		<div class="tx-attach-box-inner">
			<div id="tx_attach_preview" class="tx-attach-preview"><p></p><img src="../board/daumeditor/images/icon/editor/pn_preview.gif" width="147" height="108" unselectable="on"></div>
			<div class="tx-attach-main">
				<div id="tx_upload_progress" class="tx-upload-progress"><div>0%</div><p>파일을 업로드하는 중입니다.</p></div>
				<ul class="tx-attach-top">
					<li id="tx_attach_delete" class="tx-attach-delete"><a>전체삭제</a></li>
					<li id="tx_attach_size" class="tx-attach-size">
						파일: <span id="tx_attach_up_size" class="tx-attach-size-up"></span>/<span id="tx_attach_max_size"></span>
					</li>
					<li id="tx_attach_tools" class="tx-attach-tools"></li>
				</ul>
				<ul id="tx_attach_list" class="tx-attach-list"></ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var config = {
	txHost: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) http://xxx.xxx.com */
	txPath: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) /xxx/xxx/ */
	txService: 'sample', /* 수정필요없음. */
	txProject: 'sample', /* 수정필요없음. 프로젝트가 여러개일 경우만 수정한다. */
	initializedId: "", /* 대부분의 경우에 빈문자열 */
	wrapper: "tx_trex_container", /* 에디터를 둘러싸고 있는 레이어 이름(에디터 컨테이너) */
	form: 'tx_editor_form'+"", /* 등록하기 위한 Form 이름 */
	txIconPath: "../board/daumeditor/images/icon/editor/", /*에디터에 사용되는 이미지 디렉터리, 필요에 따라 수정한다. */
	txDecoPath: "../board/daumeditor/images/deco/contents/", /*본문에 사용되는 이미지 디렉터리, 서비스에서 사용할 때는 완성된 컨텐츠로 배포되기 위해 절대경로로 수정한다. */
	canvas: {
		styles: {
			color: "#000000", /* 기본 글자색 */
			fontFamily: "맑은 고딕", /* 기본 글자체 */
			fontSize: "12px", /* 기본 글자크기 */
			backgroundColor: "#fff", /*기본 배경색 */
			lineHeight: "1.5", /*기본 줄간격 */
			padding: "8px" /* 위지윅 영역의 여백 */
		},
		showGuideArea: false
	},
	events: {
		preventUnload: false
	},
	sidebar: {
		attachbox: {
			show: true,
			confirmForDeleteAll: true
		}
	},

	toolbar: {
		fontfamily: {
			options: [
				{ label: ' 맑은 고딕 (<span class="tx-txt">가나다라</span>)', title: '맑은 고딕', data: 'Malgun Gothic,맑은 고딕', klass: 'tx-malgun-gothic' },
				{ label: ' 굴림 (<span class="tx-txt">가나다라</span>)', title: '굴림', data: 'Gulim,굴림,AppleGothic,sans-serif', klass: 'tx-gulim' },
				{ label: ' 바탕 (<span class="tx-txt">가나다라</span>)', title: '바탕', data: 'Batang,바탕', klass: 'tx-batang' },
				{ label: ' 돋움 (<span class="tx-txt">가나다라</span>)', title: '돋움', data: 'Dotum,돋움', klass: 'tx-dotum' },
				{ label: ' 궁서 (<span class="tx-txt">가나다라</span>)', title: '궁서', data: 'Gungsuh,궁서', klass: 'tx-gungseo' },
				{ label: ' Arial (<span class="tx-txt">abcde</span>)', title: 'Arial', data: 'Arial', klass: 'tx-arial' },
				{ label: ' Verdana (<span class="tx-txt">abcde</span>)', title: 'Verdana', data: 'Verdana', klass: 'tx-verdana' }
			]
		}
	},
	size: {
		contentWidth: 900 /* 지정된 본문영역의 넓이가 있을 경우에 설정 */
	}
};

EditorJSLoader.ready(function(Editor) {
	var editor = new Editor(config);
});
</script>

<textarea id="sample_contents_source" style="display:none;">
<?=$b_contents_input?>
</textarea>

<!-- 다음 에디터 끝 -->
								</div>
							<input type="hidden" name="mode" value="<?=$mode?>">
							<input type="hidden" name="p_id" value="<?=$pidx?>">
							<input type="hidden" name="refer" value="pageAdmin">
							</form>
							<div class="clear divider"></div>
							<div class="text-center">
								<a href="pageConfig.php"><span class="button button-light btn-sm"><i class="fa fa-times left-icon"></i>작성 취소</span></a>
								<button type="button" class="button button-default btn-sm" onclick="saveContent();"><i class="fa fa-check left-icon"></i>작성 완료</button>
							</div>
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
<script type="text/javascript" language="javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
</body>
<!-- 다음 에디터 스크립트 시작 -->
<script type="text/javascript">
form = document.tx_editor_form;

function saveContent() {
	Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.
}

function validForm(editor) {
	var validator = new Trex.Validator();
	var content = editor.getContent();

	if (form.p_title.value == "") {
		alert('제목을 입력하세요.');
		form.p_title.focus();
		return false;
	} else if (!validator.exists(content)) {
		alert('내용을 입력하세요');
		return false;
	} else {
		if (confirm('작성을 완료하시겠습니까?')==1) {
			form.action = "board/board-process.php";
//			form.submit();
			return true;
		}
	}
}

	function setForm(editor) {
        var i, input;
        var form = editor.getForm();
        var content = editor.getContent();

        var textarea = document.createElement('textarea');
        textarea.name = 'content';
        textarea.value = content;
        form.createField(textarea);

        var images = editor.getAttachments('image');
        for (i = 0; i < images.length; i++) {
            // existStage는 현재 본문에 존재하는지 여부
            if (images[i].existStage) {
                // data는 팝업에서 execAttach 등을 통해 넘긴 데이터
                //alert('attachment information - image[' + i + '] \r\n' + JSON.stringify(images[i].data));
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'attach_image'+i;
                input.value = images[i].data.imageurl;  // 예에서는 이미지경로만 받아서 사용
				form.createField(input);

				input = document.createElement('input');
				input.type = 'hidden';
                input.name = 'attach_image_name'+i;
                input.value = images[i].data.filename;  // 예에서는 이미지경로만 받아서 사용
                form.createField(input);

				input = document.createElement('input');
				input.type = 'hidden';
                input.name = 'attach_image_size'+i;
                input.value = images[i].data.filesize;  // 예에서는 이미지경로만 받아서 사용
                form.createField(input);
            }
        }

		input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'attach_image_cnt';
		input.value = images.length;
		form.createField(input);

        var files = editor.getAttachments('file');
        for (i = 0; i < files.length; i++) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'attach_file'+i;
            input.value = files[i].data.attachurl;
            form.createField(input);

			input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'attach_file_name'+i;
            input.value = files[i].data.filename;
            form.createField(input);

			input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'attach_file_type'+i;
            input.value = files[i].data.filemime;
            form.createField(input);

			input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'attach_file_size'+i;
            input.value = files[i].data.filesize;
            form.createField(input);
        }

		input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'attach_file_cnt';
		input.value = files.length;
		form.createField(input);

        return true;
	}
</script>

<?
if ($mode == "modify") {
	$load_img_names = explode('::', $rs['img_names']);
	$load_img_realnames = explode('::', $rs['img_realnames']);
	$load_img_size = explode('::', $rs['img_size']);

	$load_file_names = explode('::', $rs['file_names']);
	$load_file_realnames = explode('::', $rs['file_realnames']);
	$load_file_type = explode('::', $rs['file_type']);
	$load_file_size = explode('::', $rs['file_size']);
?>

<script type="text/javascript">
	function loadContent() {
		var attachments = {};
		attachments['image'] = [];
<? for ($i=1; $i<=$rs['img_cnt']; $i++) { ?>
		attachments['image'].push({
			'attacher': 'image',
			'data': {
				'imageurl': 'http://<?=$_SERVER['HTTP_HOST']?>/upload_files/<?=$load_img_realnames[$i]?>',
				'filename': '<?=$load_img_names[$i]?>',
				'filesize': <?=$load_img_size[$i]?>,
				'originalurl': 'http://<?=$_SERVER['HTTP_HOST']?>/upload_files/<?=$load_img_realnames[$i]?>',
				'thumburl': ''
			}
		});
<? } ?>
		attachments['file'] = [];
<? for ($j=1; $j<=$rs['file_cnt']; $j++) { ?>
		attachments['file'].push({
			'attacher': 'file',
			'data': {
				'attachurl': 'http://<?=$_SERVER['HTTP_HOST']?>/upload_files/<?=$load_file_realnames[$j]?>',
				'filemime': '<?=$load_file_type[$j]?>',
				'filename': '<?=$load_file_names[$j]?>',
				'filesize': <?=$load_file_size[$j]?>
			}
		});
<? } ?>
		/* 저장된 컨텐츠를 불러오기 위한 함수 호출 */
		Editor.modify({
			"attachments": function () { /* 저장된 첨부가 있을 경우 배열로 넘김, 위의 부분을 수정하고 아래 부분은 수정없이 사용 */
				var allattachments = [];
				for (var i in attachments) {
					allattachments = allattachments.concat(attachments[i]);
				}
				return allattachments;
			}(),
			"content": document.getElementById("sample_contents_source") /* 내용 문자열, 주어진 필드(textarea) 엘리먼트 */
		});
	}

	loadContent();
</script>
<? } mysql_close($connect); ?>

<!-- 다음 에디터 스크립트 끝 -->

</html>

