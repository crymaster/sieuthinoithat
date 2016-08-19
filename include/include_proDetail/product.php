<?php
	$sqldate=strtotime($save['postTime']);
	$date=date('Y',$sqldate);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" ><!--DWLayoutTable-->
<tr>
<td width="60%" rowspan="7" align="center" valign="middle">
	<img src="image/<?php echo $save['images']; ?>" width="500px" height="249px" />
</td>
<td align="left"><span class="proName_detail"><?php echo($save['proName']);?></span></td>
<td rowspan="8" align="left" valign="top"><?php require("include/menu_support.php");?></td></tr>
<tr>
<td align="left" valign="top"><strong><img src="media/dot.png" />Giá : </strong><strong style="color:#FF0000"><?php echo(number_format($save['priceSale']));?> (VND)</strong></td>
<td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top"><strong><img src="media/dot.png" />Năm sản xuất : </strong><strong style="color:#FF0000"><?php echo  $date;?></strong></td>
<td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top"><strong><img src="media/dot.png" />Số lượng : </strong><strong style="color:#FF0000"><?php 
	if($save['status']==1)
	{
		echo "Còn hàng";
	}
	else
	{
		echo "Hết hàng";
	} ?></strong></td>
<td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top"><strong><img src="media/dot.png" />Nhà sản xuất :</strong><strong style="color:#FF0000"><?php echo $save['subName'];?></strong></td>
<td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<?php
$sql_cate = "SELECT     *
FROM   group_category where group_category.gpCateID =".$gpCateID;
$re_cate = mysql_query($sql_cate,$connect);
$row_cate = mysql_fetch_array($re_cate); 
?>
<img src="media/dot.png" /><strong>Loại sản phẩm : </strong><strong style="color:#FF0000"><?php echo $row_cate['gpCateName'];?></strong></td>
<td>&nbsp;</td></tr>
<tr>

<td height="32" align="left" valign="middle"><a href="index.php?go=shoppingcart&action=add&pid=<?php echo($save['proID'])?>"> <img src="media/IndexChoVaoGio.jpg" border="0" /> </a></td>
</tr>
<tr>
<td height="30" colspan="2" align="left" valign="middle"><em><strong><?php echo($save['proDes']);?></strong></em></td>
<td>&nbsp;</td></tr>
</table>
