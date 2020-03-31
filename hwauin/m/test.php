<?php
try{
	$dsn = 'mysql:host=localhost;dbname=hwauin';
	$username = 'hwauin';
	$password = 'thwls1521';
	$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);
	$pdo = new PDO($dsn, $username, $password, $options);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
	echo "실패 : ".$e->getMessage();
}

$mem_id = $_REQUEST['id'];

$dbq = $pdo->prepare("select mem_name from m_member where mem_id=:mem_id");
$dbq->bindParam(":mem_id", $mem_id, PDO::PARAM_STR);
$dbq->execute();

$count = $dbq->rowCOunt();

$st->setFetchMode(PDO::FETCH_ASSOC);
// 1 row 씩 가져오기
while($row= $st->fetch()) {
	echo $row[0].'<br/>';
}



$sql_result= $dbq->fetchAll(PDO::FETCH_ASSOC);

echo $count;
exit;
?>
<?php

try{
    $dsn = 'mysql:host=183.110.200.236;dbname=boom';
    $username = 'boom';
    $password = 'boom20#&!';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    $dbh = new PDO($dsn, $username, $password, $options);


    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
    echo "실패 : ".$e->getMessage();
}

?>
<?php


$user = $_REQUEST['id'];
$password = $_REQUEST['pw'];

// Query
$que = sprintf("SELECT * FROM boom_member WHERE mb_id='%s' AND mb_pw='%s'",
    mysql_real_escape_string($user),
    mysql_real_escape_string($password));
//$res = mysql_query($que);

//$row = mysql_fetch_array($res);

//echo $row['mb_id'];
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>컴퓨터 선택</title>
</head>
<script language="javascript" src="in.js"></script>
<script language="javascript">
</script>
</head>
<body>
<form name="form1">
<select name="first" onchange="firstChange();" size=1>
<option value=''>대분류</option>
<option value=''>컴퓨터</option>
<option value=''>프린터</option>
</select>
<select name="second" onchange="secondChange();" size=1>
 <option value=''>대분류를 먼저 선택하세요</option>
</select>
<select name="third" size=1>
 <option value=''>중분류를 먼저 선택하세요</option>
</select>
</form>
</body>
</html>
<? include "inc/link.php"; ?>
<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));

$sql_main ="SELECT * FROM mainConfig m, contentConfig c WHERE m.service1_link = c.idx AND m.idx=1";
$rs_min = mysql_fetch_array(mysql_query($sql_main));

if (isset($rs_min['contentKind'])==""){
	$link11 ="#";
}else{
	$link11 = "sub.php?ck=".$rs_min['contentKind']."&id=".$rs_min['contentId'];
}
echo $link11
?>