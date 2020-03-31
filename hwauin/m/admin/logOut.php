<?
session_start();
session_destroy();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
	alert('정상적으로 로그아웃되었습니다.');
	location.href='index.php';
</script>