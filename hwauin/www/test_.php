<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>insertBefore demo</title>
  <style>
  #foo {
    background: yellow;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

<p style="display:none" id="test_view">I would like to say: </p> 
<div id="foo">FOO!</div>
 
 <input type="button" id="test" value="ㅊ슽츠">
<script>
$(function(){
//$( "p" ).insertBefore( "#foo" );
	$("#test").on("click",function(){
		console.log($("#test_view").html());
		$("#foo").append( $("#test_view") );
		$("#test_view").last().show();
		
	});
});
</script>
 
</body>
</html>