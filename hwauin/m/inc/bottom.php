<? 
$sql = "SELECT * FROM siteConfig WHERE idx=1";
$rs = mysql_fetch_array(mysql_query($sql));
?>
<div class="content-title">
	<a href="tel:<?=$rs['siteTel']?>" class="section-icon"><i class="fa fa-phone" style="margin-top: 7px;"></i></a>
    <h2>문의 / 고객센터 전화</h2>
    <p><?=htmlspecialchars($rs['siteCStime'])?></p>
</div>
<div class="content">
    <div class="container no-bottom">
    	<div class="footer">
            <a href="tel:<?=$rs['siteTel']?>" class="footer-icon bg-gray"><i class="fa fa-phone" style="margin-top: 7px;"></i></a>
            <a href="#" class="footer-icon gotoup bg-gray"><i class="fa fa-arrow-up" style="margin-top: 7px;"></i></a>
            <a href="./" class="footer-icon bg-gray"><i class="fa fa-home" style="margin-top: 7px;"></i></a>
        </div>
		<div class="clear"></div>
    	<p class="center-text half-top"><?=$rs['siteCopyright']?></p>
    </div>
</div>
