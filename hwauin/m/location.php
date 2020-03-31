<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="">
<meta name="description" content="">
<title>모바일 홈페이지</title>
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
function initialize() { //지도API
  var mapOptions = {
    scaleControl: true,
    center: new google.maps.LatLng(37.483552,126.893595),
    zoom: 15
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    position: map.getCenter()
  });
  var infowindow = new google.maps.InfoWindow();
  infowindow.setContent('<b>서울 구로 </b>');
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<body>
<? include "inc/top.php"?>
<div class="content-title">
    <h2><?=htmlspecialchars($rs['mapName'])?></h2>
    <p><?=htmlspecialchars($rs['mapMemo'])?></h4>
</div>
<div class="content">
	<div class="column no-bottom">
		<div class="container half-bottom">
			<h3>약도 안내</h3>
		</div>
		<div class="decoration"></div>    
        <div class="container">
            <div class="maps-container">
        		  <div id="map-canvas" class="map"></div>
            </div>
        </div>
		<div class="clear"></div>
		<div class="decoration"></div>
		<div class="container">
            <h3 class="half-bottom"><span class="icon"><i class="fa fa-map-marker" style="margin-top: 7px;"></i></span> 주소</h3>
			<p class="no-bottom"><?=htmlspecialchars($rs['siteAddress'])?><br><?=htmlspecialchars($rs['siteAddress2'])?></p>
		</div>
		<div class="container">
			<h3 class="half-bottom"><span class="icon"><i class="fa fa-clock-o" style="margin-top: 7px;"></i></span> 운영시간</h3>
			<p class="no-bottom"><?=htmlspecialchars($rs['siteCStime'])?></p> 
		</div>
	</div>
</div>
<? unset($rs); ?>
<? include "inc/bottom.php"; ?>
</body>
</html>