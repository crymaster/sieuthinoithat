
<div id='img3' style='display:none'>
<?php
$sql="select * from product , product_category  where  product.proID = product_category.proID and  product_category.cateID = ".$cateID." and product.status = 1 and product.proID !=".$proid." limit 0,4 ";
$result = mysql_query($sql,$connect);

$num=mysql_num_rows($result);

?>
<?php if($num>=1) {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="borderAllTable"><table border="0"  width="33%" cellpadding="0" cellspacing="0">
<tr>
<?php
while($row=mysql_fetch_array($result))
{
?>
<td align="center"><span class="timnangcao"> 
<a href="index.php?go=product_detail&cateID=<?php echo $row['cateID'];?>&pid=<?php echo($row['proID']);?>&gpCateID=<?php echo $gpCateID; ?>">
<?php echo($row['proName']);?></a> <br />
<a href="index.php?go=product_detail&cateID=<?php echo $row['cateID'];?>&pid=<?php echo($row['proID']);?>&gpCateID=<?php echo $gpCateID; ?>">
<img src="image/<?php echo($row['images']);?>"  border="0" width="200px" height="200px" title="<?php echo($row['proDes']);?>"/>
</a> <br />
Giá:<?php echo(number_format($row['priceSale']));?> VND </span>
</td>
<?php
}
?>
</tr>
</table></td>
</tr>
</table>
<?php }?>
</div>
