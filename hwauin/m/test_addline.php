
<!doctype html>
<html>
<head>

<meta property="og:image" content="http://boom.booms.kr/v_logo.png">

<meta charset="utf-8">
<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

</head>
<body>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=iDqPVHN3MnbVeslFh7oq&submodules=geocoder"></script>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
	<div id="main_box" class="inner_box">
		<main id="main">
			<form name="fboardform" id="fboardform" method="post" OnSubmit="return submitContents('','');" enctype="multipart/form-data">
<div class="write_option product_detail" style="position:relative;">
	<div id="ad"></div>
	<div style="position:absolute; bottom:10px; right:10px;">
		<button id="deleteAd" type="button" style="padding:3px 8px; border:1px solid #5d5d5d; background-color:#f3f3f3; color:#363636; font-size:12px;"><span style="margin-right:3px; color:#0072bc; font-weight:bold; font-size:14px; ">-</span>삭제</button>
		<button id="insertAd" type="button" style="padding:3px 8px; border:1px solid #5d5d5d; background-color:#f3f3f3; color:#363636; font-size:12px;"><span style="margin-right:3px; color:#eb6100; font-weight:bold; font-size:14px; ">+</span>추가</button>
	</div>
</div>

<div id="ad_sample" style="display:none;">
	<div class="write_th"></div>
	<div class="write_td">
		<div class="ad_subway">
			<div class="write_th2">역사명</div>
						<select class="train_gubun" name="train_gubun[]">
							<option value="">지역</option>
								<option value="서울">서울</option>
								<option value="부산">부산</option>
								<option value="인천">인천</option>
								<option value="경의중앙">경의중앙</option>
								<option value="신분당">신분당</option>
								<option value="분당">분당</option>
								<option value="대구">대구</option>
								<option value="수인선">수인선</option>
								<option value="경강선">경강선</option>
							</select> 

			<select class="train_line" name="train_line[]">
				<option value="">호선</option>
			</select>

			<select class="train_name" name="train_name[]">
				<option value="">역사명</option>
			</select>
		</div>


		<div class="ad_period">
			<div class="write_th2">계약기간</div>
			<span>

				<select class="ad_year">
					<option>2018</option>
					<option>2019</option>
				</select>
				년 &nbsp;
				<select class="ad_month">
					<option>1</option>
				</select>
				월 &nbsp;
				<select class="ad_date">
					<option>1~10</option>
				</select>
				일 &nbsp;
			</span>
		</div>

		<div class="ad_exposure">
			<div class="write_th2">노출시간</div>
			<span>
				<select name="product_stime[]" class="product_stime">
					<option value="">선택</option>
				</select>
				부터
				<select name="product_etime[]" class="product_etime">
					<option value="">선택</option>
				</select>
				까지
			</span>
		</div>
	</div>
	<!-- 구분선인데 마지막꺼에 들어가있음 -->
	<hr style="margin:0; padding:0;  border:0.5px solid #ddd;">
</div>

<script>

//광고설정 갯수
var ad_count = 0;

//ad_count가 0이하일때는 버튼이 안보이고 1일때는 삭제가 안보이고 2이상일때는 둘다 보이게
function visibleBtn(){
	if(ad_count <= 0){
		$("#insertAd").hide();
		$("#deleteAd").hide();
	}else if(ad_count == 1){
		$("#deleteAd").hide();
	}else{
		$("#insertAd").show();
		$("#deleteAd").show();
	}
}

$("#insertAd").click(function(){
	ad_count++;
	$("#ad").append( "<div class='ad_setting'>" + $("#ad_sample").html() + "</div>" );
	$("#ad .ad_setting").last().children(".write_th").html("*광고설정" + ad_count);
	visibleBtn();
});

$("#deleteAd").click(function(){
	ad_count--;
	$("#ad .ad_setting").last().remove();
	visibleBtn();
});

//1개 추가해둠
$("#insertAd").click();


/* s:역사명 */
$(document).on("change",".train_gubun",function(){
	var $this0 = $(this);
	$this0.siblings(".train_name").html("<option value=''>역사명</option>");
	$.ajax({
		type: "POST",
		url : "/ajax/train_view_array_test.php",
		dataType: "json",
		data: {
			mode : "train_line",
			train_gubun : $this0.val(),
		},
		success:function(data){
			var result = eval(data);
			if(result["status"] == "OK"){
				$this0.siblings(".train_line").html("<option value=''>호선</option>");
				for(i=0; i < result["message"].length ; i++){
					$this0.siblings(".train_line").append("<option value='" + result["message"][i] + "'>" + result["message"][i] + "</option>");
				}
			}
		},
		error : function(data) {
			alert("ERROR : " + data);
		}
	});
});

$(document).on("change",".train_line",function(){
	var $this0 = $(this);
	$.ajax({
		type: "POST",
		url : "/ajax/train_view_array_test.php",
		dataType: "json",
		data: {
			mode : "train_name",
			train_gubun : $this0.siblings(".train_gubun").val(),
			train_line : $this0.val(),
		},
		success:function(data){
			var result = eval(data);
			if(result["status"] == "OK"){
				$this0.siblings(".train_name").html("<option value=''>역사명</option>");
				for(i=0; i < result["message"].length ; i++){
					$this0.siblings(".train_name").append("<option value='" + result["message"][i] + "'>" + result["message"][i] + "</option>");
				}
			}
		},
		error : function(data) {
			alert("ERROR : " + data);
		}
	});
});

/* e:역사명 */


/* s:계약기간 */

//년을 바꾸면 월과 일이 초기화됨.
$(document).on("change",".ad_year",function(){
	var ad_year = $(this).val() * 1;
	$(this).siblings(".ad_month").val(1);
	$(this).siblings(".ad_month").change();
});

//월에 따라 일의 마지막일수가 바뀜 ( 2월은 년도와도 관계있음 )
$(document).on("change",".ad_month",function(){

	var ad_year = $(this).siblings(".ad_year").val() * 1;
	var ad_month = $(this).val() * 1;
	var max_date = 31;

	switch(ad_month){
		case 1:
			max_date = 31; break;
		case 2:

			//윤년 처리
			if(ad_year % 4 == 0){
				max_date = 29;
			}else{
				max_date = 28; 
			}
			break;

		case 3:
			max_date = 31; break;
		case 4:
			max_date = 30; break;
		case 5:
			max_date = 31; break;
		case 6:
			max_date = 30; break;
		case 7:
			max_date = 31; break;
		case 8:
			max_date = 31; break;
		case 9:
			max_date = 30; break;
		case 10:
			max_date = 31; break;
		case 11:
			max_date = 30; break;
		case 12:
			max_date = 31; break;
		default :
			max_date = 31; break;
	}

	$(this).siblings(".ad_date").html("");
	$(this).siblings(".ad_date").append("<option>1~10</option>");
	$(this).siblings(".ad_date").append("<option>11~20</option>");
	$(this).siblings(".ad_date").append("<option>21~" + max_date + "</option>");

});
/* e:계약기간 */

/* s:노출시간 */
$(".product_stime").html("<option>선택</option>");

for(var i=0; i<24 ;i++){
	hour = "0" + i;
	hour = hour.substr(hour.length - 2,2);
	$(".product_stime").append("<option>" + hour + ":00</option>");
}

$(document).on("change",".product_stime",function(){
	var s_hour = $(this).val();
	s_hour = s_hour.split(":");
	s_hour = s_hour[0]*1

	$(this).siblings(".product_etime").html("<option>선택</option>");

	for(var i=s_hour; i<24 ;i++){
		e_hour = "0" + i;
		e_hour = e_hour.substr(e_hour.length - 2,2);
		$(this).siblings(".product_etime").append("<option>" + e_hour + ":59</option>");
	}
});


/* e:노출시간 */

</script>
</body>
</html>

