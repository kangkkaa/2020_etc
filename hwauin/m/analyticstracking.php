<?
$sqlgo="SELECT * FROM googleAnalytics WHERE no=1";
$rsgo = mysql_fetch_array(mysql_query($sqlgo));
?>
<?if($rsgo['state']=="Y"){ ?>
<script>
<?echo(stripslashes($rsgo['content'])); }?>
</script>
