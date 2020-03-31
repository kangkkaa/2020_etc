<script language="JavaScript">
function goPage(npage) {
	form = document.searchForm;
	form.npage.value = npage;
	form.action = "";
	form.submit();
}
</script>
<ul class="pagination pagination-sm">
<? if ($recordcount > 0) { 
$pagecount = ceil($recordcount/$page_size);
$beginblock = floor(($npage-1)/$page_block) * $page_size;

if ($npage > 1) {
?>
<li><a href="javascript:goPage(<?=($npage-1)?>);">&lt;</a></li>  
<? } else { ?>
<li><a href="#">&lt;</a></li>
<? } if (($pagecount - $beginblock) < $page_block) {
	for ($x=1; $x <= ($pagecount % $page_block); $x++) {
		if ( $beginblock+$x == $npage) {
?>
<li class="active"><a href="#"><?=$beginblock+$x ?></a></li>
	<? } else { ?>

<li><a href="javascript:goPage(<?=($beginblock+$x)?>);"><?=($beginblock+$x)?></a></li>  
<? 		} 
	}
} else {
	for ($x=1; $x <= $page_block; $x++) {
		if ($beginblock+$x == $npage) {
?>
<li>&nbsp;&nbsp;<?=$beginblock+$x?></li> 
<?		} else { ?>
<li><a href="javascript:goPage(<?=($beginblock+$x)?>);"><?=$beginblock+$x ?></a></li> 
<?		}
	}
}
if ($pagecount > 1 && $pagecount >= ($npage+1)) {
?>
<li><a href="javascript:goPage(<?=($npage+1)?>);">&gt;</a></li>
<?
 } else { ?>
<li><a href="#">&gt;</a></li>
<? } } ?>
</ul>