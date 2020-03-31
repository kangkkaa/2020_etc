<?
include "../inc/link.php";
include "libs/SyndicationStatus.class.php";

$sql = "SELECT * FROM syndication WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));


// 내 도메인 주소 입력 - 예: www.mydomain.com
$mydomain =  $rs['url'];//"gsi123.mireene.com";

$oStatus = new SyndicationStatus;
$oStatus->setSite($mydomain);
$result = $oStatus->request();

print_r($result);
?>