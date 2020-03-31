<script language="JavaScript">
function goPage(npage) {
	form = document.searchForm;
	form.npage.value = npage;
	form.action = "";
	form.submit();
}
</script>
<? if ($recordcount > 0) { 
$pagecount = ceil($recordcount/$page_size);
$beginblock = floor(($npage-1)/$page_block) * $page_size;

if ($npage > 1) {
?>
<a href="javascript:goPage(<?=($npage-1)?>);"><span class="button btn-mini button-inverse"><i class="fa fa-caret-left"></i></span></a>
<?
} else { ?>
<a href="#"><span class="button btn-mini button-inverse"><i class="fa fa-caret-left"></i></span></a>
<?
}
if (($pagecount - $beginblock) < $page_block) {
	for ($x=1; $x <= ($pagecount % $page_block); $x++) {
		if ( $beginblock+$x == $npage) {
?>
<a href="#"><span class="button btn-mini button-warning"><?=$beginblock+$x ?></span></a>
	<? } else { ?>

<a href="javascript:goPage(<?=($beginblock+$x)?>);"><span class="button btn-mini button-warning"><?=($beginblock+$x)?></span></a>
<? 		} 
	}
} else {
	for ($x=1; $x <= $page_block; $x++) {
		if ($beginblock+$x == $npage) {
?>
<li>&nbsp;&nbsp;<?=$beginblock+$x?></li> 
<?		} else { ?>
<a href="javascript:goPage(<?=($beginblock+$x)?>);"><span class="button btn-mini button-warning"><?=$beginblock+$x ?></span></a> 
<?		}
	}
}
if ($pagecount > 1 && $pagecount >= ($npage+1)) {
?>
<a href="javascript:goPage(<?=($npage+1)?>);"><span class="button btn-mini button-inverse"><i class="fa fa-caret-right"></i></span></a>
<?
 } else { ?>
<a href="#"><span class="button btn-mini button-inverse"><i class="fa fa-caret-right"></i></span></a>
<?
}
}?>