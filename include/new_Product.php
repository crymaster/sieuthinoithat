
<?php
$sql11 ="select product.* ,category.cateID,group_category.gpCateID from product INNER JOIN product_category ON product.proID=product_category.proID
INNER JOIN category ON product_category.cateID=category.cateID
INNER JOIN group_category ON category.gpCateID=group_category.gpCateID
 where product.status = 1 and group_category.gpCateID ='".$_REQUEST['gpCateID']."'order by product.postTime desc limit 0,5";
$resuilt11 = mysql_query($sql11); 
$row_count=mysql_num_rows($resuilt11);
?>

<table width="100%" border="0" class="borderAllTable" cellspacing="0" cellpadding="0">
<tr height="33px"><th style="color:#fff;">
	Sản Phẩm Mới
	</th>
</tr>
<tr>
	<td bgcolor="#FFFFFF">
	<?php
	while($row11=mysql_fetch_array($resuilt11))
	{
	?>
	<ul class="menunews">
	<li>
	
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
	<td>
	<a href="index.php?go=product_detail&cateID=<?php echo $row11['cateID'] ?>&pid=<?php echo $row11['proID'];?>&gpCateID=<?php echo $row11['gpCateID'] ?>">
	<img border="0"  height="60" width="70"src="image/<?php echo $row11['images'];?> " /></a></td>
	<td>
	<a href="index.php?go=product_detail&cateID=<?php echo $row11['cateID'] ?>&pid=<?php echo $row11['proID'];?>&gpCateID=<?php echo $row11['gpCateID'] ?>">
	<?php echo $row11['proName'];?>
	</a></td>
	<?php
		if($row_count==0){
		?>
	<td><h6> Sản phẩm đang được cập nhật </h6></td>
			
		
	<?php	
	}
	?>
</tr>
	
</table>
</li>
</ul>
<?php }?>
</td>
</tr>
</table>












