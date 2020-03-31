<? include_once("analyticstracking.php"); ?>
<div id="preloader">
	<div id="status">
    	<p class="center-text">
			모바일 홈페이지            
			<em>페이지를 로딩중입니다. 잠시만 기다려주세요</em>
        </p>
    </div>
</div>
<div class="header">										
	<a href="./" class="logo"><img src="../board/upload_files/<?=$rs['siteLogo']?>" border="0" width="150"></a>
    <a href="#" class="navi-open-btn"><i class="fa fa-bars" style="margin-top: 15px;"></i></a>
    <a href="#" class="navi-close-btn"><i class="fa fa-times" style="margin-top: 15px;"></i></a>
</div>
<? $menusql = "SELECT * FROM menuAdmin WHERE dept=1 ORDER BY sortNo";
   $resultm = mysql_query($menusql) or die(mysql_error());
?>
<div class="navigation">
	<div class="navigation-item">
    	<a href="./" class="nav-icon"><i class="fa fa-home"></i>&nbsp;처음으로</a>
    </div>
<? while($rsm = mysql_fetch_array($resultm)){ ?>
<? $sqlcon = "SELECT * FROM contentConfig WHERE idx = '".$rsm['contentIdx']."'";
   $rscon = mysql_fetch_array(mysql_query($sqlcon));
	   if($rsm['contentIdx']==0){
			$link ="#";
			$class = "nav-icon submenu-icon";
		}else{
			$link = "sub.php?ck=".$rscon['contentKind']."&id=".$rscon['contentId'];
			$class= "nav-icon";
		}
?>
	<div class="navigation-item">
    	<a href='<?=$link?>' class='<?=$class?>'><i class='fa fa-arrow-circle-right'></i>&nbsp;<?=$rsm['menuName']?><em class='submenu-item'></em></a>        
<? if($rsm['subUseYN']=="Y"){
	$subsql = "SELECT * FROM menuAdmin WHERE dept='2' AND mainMenu ='".$rsm['idx']."' ORDER BY sortNo";
	$subresult = mysql_query($subsql) or die(mysql_error()); 
?>
		<div class="submenu">
<? while($surs = mysql_fetch_array($subresult)){ ?>
<? $sqlcon1 = "SELECT * FROM contentConfig WHERE idx = '".$surs['contentIdx']."'";
   $rscon1 = mysql_fetch_array(mysql_query($sqlcon1));
	   if($surs['contentIdx']==0){
			$link1 ="#";
		}else{
			$link1 = "sub.php?ck=".$rscon1['contentKind']."&id=".$rscon1['contentId'];
		}
?>
        	<ul>
				<li><a href="<?=$link1?>" class="subnav-icon"><i class="fa fa-caret-right"></i>&nbsp;<?=$surs['menuName']?></a></li>
			</ul>
<? }//sub-while ?>
        </div>
<? }//sub-while ?>
    </div>
<? } ?>
</div>