<table width="100%" border="0">
<tr >
<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THỐNG KÊ CHUNG</span> </td>
</tr>

<tr>
<td height="150" align="center" valign="top">

<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td class="row_one" colspan="2" align="center" valign="middle">SẢN PHẨM </td>
</tr>
<tr>
<td class="row" width="61%" align="left">Số lượng loại sản phẩm </td>
<?php
	$sql_cate="select * from group_category";
	$re_cate=mysql_query($sql_cate,$connect);
	$num_cate=mysql_num_rows($re_cate);
?>
<td class="row" width="39%"><?php echo $num_cate?> </td>
</tr>
<tr>
<?php
	$sql_sup="select * from Supplier";
	$re_sup=mysql_query($sql_sup,$connect);
	$num_sup=mysql_num_rows($re_sup);
?>	  
<td class="row" align="left">Số lượng nhà cung cấp </td>
<td class="row"><?php echo $num_sup?></td>
</tr>
<tr>
<td class="row" align="left">Số lượng dòng sản phẩm </td>
	<?php
	$sql_mod="select * from category";
	$re_mod=mysql_query($sql_mod,$connect);
	$num_mod=mysql_num_rows($re_mod);
	?>		
<td class="row"><?php echo $num_mod?></td>
</tr>
<tr>
<td class="row" align="left">Tổng số lượng sản phẩm </td>
<?php
$sql_pro="select * from Product";
$re_pro=mysql_query($sql_pro,$connect);
$num_pro=mysql_num_rows($re_pro);
?>		
<td class="row"><?php echo $num_pro?></td>
</tr>
<tr>
<td class="row" align="left">Số lượng sản phẩm đang bán </td>
<?php
$sql_pro1="select * from Product where Status = 1";
$re_pro1=mysql_query($sql_pro1,$connect);
$num_pro1=mysql_num_rows($re_pro1);
?>		
<td class="row"><?php echo $num_pro1?></td>
</tr>
<tr>
<td class="row" align="left">Số lượng sản phẩm tạm dừng bán </td>
<?php
$sql_pro0="select * from Product where Status = 0";
$re_pro0=mysql_query($sql_pro0,$connect);
$num_pro0=mysql_num_rows($re_pro0);
?>		
<td class="row"><?php echo $num_pro0?></td>
</tr>
</table>	</td>
<td align="center" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td  class="row_one" colspan="2" align="center" valign="middle">HÓA ĐƠN </td>
</tr>
<tr>
<td class="row" width="61%" align="left">Số lượng tất cả hóa đơn </td>
<?php
$sql_orders="select * from orders";
$re_orders=mysql_query($sql_orders,$connect);
$num_orders=mysql_num_rows($re_orders);
?>
<td class="row" width="39%"><?php echo $num_orders?></td>
</tr>
<tr>
<?php
$date = date("y-m-d");
$sql_hd3="select * from orders where oDateCreate='".$date."'";
$re_hd3=mysql_query($sql_hd3,$connect);
$num_hd3=mysql_num_rows($re_hd3);
?>	  
<td class="row" align="left">Hóa đơn mới </td>
<td class="row"><?php echo $num_hd3?></td>
</tr>
<tr>
<td class="row" align="left">Hóa đơn chưa xử lý </td>
<?php
$sql_orders1="select * from orders where Status =1";
$re_orders1=mysql_query($sql_orders1,$connect);
$num_orders1=mysql_num_rows($re_orders1);
?>		
<td class="row"><?php echo $num_orders1?></td>
</tr>
<tr>
<td class="row" align="left">Hóa đơn đang xử lý </td>
<?php
$sql_orders2="select * from orders where Status =2";
$re_orders2=mysql_query($sql_orders2,$connect);
$num_orders2=mysql_num_rows($re_orders2);
?>		
<td class="row"><?php echo $num_orders2?></td>
</tr>
<tr>
<td class="row" align="left">Hóa đơn đã xử lý </td>
<?php
$sql_orders3="select * from orders where Status =3";
$re_orders3=mysql_query($sql_orders3,$connect);
$num_orders3=mysql_num_rows($re_orders3);
?>		
<td class="row"><?php echo $num_orders3?></td>
</tr>
</table></td>
</tr>
<tr>
<td height="150" align="center" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td class="row_one" colspan="2" align="center" valign="middle">KHÁCH HÀNG </td>
</tr>
<tr>
<td class="row" width="61%" align="left">Tổng số tài khoản khách hàng </td>
<?php
$sql_cus="select * from Customers";
$re_cus=mysql_query($sql_cus,$connect);
$num_cus=mysql_num_rows($re_cus);
?>		
<td class="row" width="39%"><?php echo $num_cus?></td>
</tr>
<tr>
<td class="row" align="left">Số tài khoản đã mua hàng </td>
<?php
$sql_cus_orders="Select *
From Customers
Where cID  In (Select cID From Orders )";
$re_cus_orders=mysql_query($sql_cus_orders,$connect);
$num_cus_orders=mysql_num_rows($re_cus_orders);
?>		

<td class="row"><?php echo $num_cus_orders?></td>
</tr>
<tr>
<td class="row" align="left">Số tài khoản bị khóa </td>
<?php
$sql_cus0="select * from Customers where Status =0";
$re_cus0=mysql_query($sql_cus0,$connect);
$num_cus0=mysql_num_rows($re_cus0);
?>		
<td class="row"><?php echo $num_cus0?></td>
</tr>



</table></td>
<td align="center" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td class="row_one" colspan="2" align="center" valign="middle">THỐNG KÊ KHÁC </td>
</tr>
<tr>
<td class="row" width="61%" align="left">Số lượng tin tức </td>
<?php
$sql_news="select * from News";
$re_news=mysql_query($sql_news,$connect);
$num_news=mysql_num_rows($re_news);
?>		
<td class="row" width="39%"><?php echo $num_news?></td>
</tr>
<tr>
<td class="row" align="left">Số lượng phản hồi </td>
<?php
$sql_feed="select * from Feedback";
$re_feed=mysql_query($sql_feed,$connect);
$num_feed=mysql_num_rows($re_feed);
?>		
<td class="row"><?php echo $num_feed?></td>
</tr>
<tr>
<td class="row" align="left">Số lượng phản hồi bị khóa </td>
<?php
$sql_feed0="select * from Feedback where Status=0";
$re_feed0=mysql_query($sql_feed0,$connect);
$num_feed0=mysql_num_rows($re_feed0);
?>		
<td class="row"><?php echo $num_feed0?></td>
</tr>

</table></td>
</tr>
</table>
