
<?php
$sql12 ="select product.* ,count(*),sum(orderdetail.quantity),orderdetail.status,category.cateID,group_category.gpCateID from orderdetail inner join product on orderdetail.proID=product.proID inner join product_category on product.proID=product_category.proID
inner join category on product_category.cateID=category.cateID 
inner join group_category on category.gpCateID=group_category.gpCateID
group by(product.proID)
having orderdetail.status=3
order by sum(orderdetail.quantity) desc limit 0,5";
$resuilt12 = mysql_query($sql12); 
?>
<div id="left_menu">
<table width="100%" border="0" class="borderAllTable" cellspacing="0" cellpadding="0">
<tr height="33px"><th style="color:#fff;">
Sản Phẩm Bán Chạy
</th>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<?php
while($row12=mysql_fetch_array($resuilt12))
{
?>
<ul class="menunews">
<li>

<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td>
<a href="index.php?go=product_detail&cateID=<?php echo $row12['cateID'] ?>&pid=<?php echo $row12['proID'];?>&gpCateID=<?php echo $row12['gpCateID'] ?>">
<img border="0"  height="60" width="70"src="image/<?php echo $row12['images'];?> " /></a></td>
<td>
<a href="index.php?go=product_detail&cateID=<?php echo $row12['cateID'] ?>&pid=<?php echo $row12['proID'];?>&gpCateID=<?php echo $row12['gpCateID'] ?>">
<?php echo $row12['proName'];?>
</a></td>
</tr>
</table>
</li>
</ul>
<?php }?>
</td>
</tr>
</table>
</div>











