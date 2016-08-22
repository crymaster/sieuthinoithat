<?php
$record_per_page = 15;
$pagenum = $_GET["page"];
$page = "admin.php?go=product_list";
?>
<?php
	if($supID==0)
	{
		$sql = "SELECT     *
		FROM         supplier INNER JOIN
		product ON supplier.subID = product.subID INNER JOIN
		product_category ON product.proID = product_category.proID order by product.proID ";
	}
	else{
		$sql = "SELECT     *
		FROM         supplier INNER JOIN
		product ON supplier.subID = product.subID INNER JOIN
		product_category ON product.proID = product_category.proID where product.subID='".$supID."'";
	}


$resuilt=mysql_query($sql,$connect);
if($resuilt)
{
	$totalpage =ceil( mysql_num_rows($resuilt) / $record_per_page);
	
	if(!$pagenum || $pagenum <=0 || $pagenum > $totalpage)
	{
	$pagenum = 1;
	} 
	if($pagenum == 1)
	{
	$from = 0;
	}else{
	$from = ($pagenum-1)*$record_per_page;
	}
	$sql =$sql." LIMIT ".$from.",".$record_per_page;
	$resuilt=mysql_query($sql);
}
?>
<table width="100%" border="0" cellpadding="3" cellspacing="3" >
<tr>
<td height="50" colspan="8" align="center" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH SẢN PHẨM </span></td>
</tr>
<tr>
<td class="row" colspan="8" align="center">Xem sản phẩm theo
<label>
<select name="select2" onChange="location.href='admin.php?go=product_list&action=Supplier&supID='+this.value+'&page=<?php echo($pagenum)?>'">
<option value="0">-Tất cả nhà cung cấp-</option>
<?php
$sql_sup="Select * from Supplier";
$resuilt_sup=mysql_query($sql_sup);

?>
<?php
while($row_sup=mysql_fetch_array($resuilt_sup))
{
if($row_sup['subID']==$supID)
{
?>
<option value="<?php echo $row_sup['subID'];?>" selected="selected"><?php echo $row_sup['subName'];?></option>
<?php } else{?>
<option value="<?php echo $row_sup['subID'];?>"><?php echo $row_sup['subName'];?></option>
<?php }  }?>
</select>
</label></td>
</tr>
<tr>
<td width="10%" align="center" class="row_one"><label></label>Mã </td>
<td class="row_one" width="13%" align="center">Ảnh</td>
<td class="row_one" width="17%" align="center">Tên sản phẩm </td>
<td class="row_one" width="17%" align="center">Giá SP </td>
<td class="row_one" width="16%" align="center">Ngày tháng </td>
<td width="15%" align="center" class="row_one">Trạng thái </td>
<td class="row_one" colspan="2" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
if($resuilt)
{
while($row=mysql_fetch_array($resuilt))
{
?>  
<tr onMouseOver="this.className='over'" onMouseOut="this.className='out'" class="out">
<td class="row" align="center"><label></label>      <?php echo $row['proID'];?></td>
<td class="row" align="center">
<a href="admin.php?go=product_edit&action=update&proID=<?php echo $row['proID'];?>">
<img  height="50" width="60"src="../image/<?php echo $row['images'];?> " /></a></td>
<td class="row" align="center"><?php echo $row['proName'];?></td>
<td class="row" align="center"><?php echo(number_format($row['priceSale']));?> VND</td>
<?php 
	$xulyngay=strtotime($row['postTime']);
	$xulyngayOK=date('d-m-Y',$xulyngay);
 ?>
<td class="row" align="center"><?php echo $xulyngayOK;?></td>
<td align="center" class="row">
<select name="proStatus" onchange="location.href='admin.php?go=product_list&action=change&proID=<?php echo $row['proID'];?>&status='+this.value;">
<?php if($row['status']==1) {?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php } else {?>

<option value="0">Ẩn</option>
<option value="1">Hiện</option>
</select><?php }?>	</td>
<td class="row" width="6%" align="center"><a href="admin.php?go=product_edit&action=update&proID=<?php echo $row['proID'];?>">Sửa</a></td>
<td class="row" width="6%" align="center">

<?php
// Chu y o day neu neu san pham co trong orderdetail thi khong duoc xoa san pham
$sql_check="Select * from orderdetail where proID=".$row['proID'];
$re1=mysql_query($sql_check,$connect);
$ok=0;
while($row1=mysql_fetch_array($re1))
{
	$ok=1;
}
if($ok==1)
{
	echo("||||");
}
else{
?>


<a href="admin.php?go=product_list&action=del&proID=<?php echo $row['proID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>	   <?php }?></td>
</tr>
<?php } }?> 
</table>
<?php
/*
Vong lap de tao ra cac link lien ket den cac trang du lieu.
Output: 	1 | 2 | 3 | 4 
*/
for($i =1; $i<=$totalpage;$i++)
{
if ($i==1){
echo "<a href='".$page."&page=".$i."' >".$i."</a>"	;	
}else{
if($pagenum==$i)			
echo " | <a href='".$page."&page=".$i."'><B><font color=red><u>".$i."</u></font></B></a>";
else
echo " | <a href='".$page."&page=".$i."'>".$i."</a>";
}
}
echo("<font color=red>  &nbsp; &nbsp;(Page: &nbsp; ".$pagenum."&nbsp;/&nbsp;".$totalpage.")");
?>
<?php
$action = $_REQUEST['action'];
if($action == 'del')
{
	$proID =$_REQUEST['proID'];
	
	//Xoa file Anh trong thu muc :: image
	$sql_img = "select * from product WHERE proID = $proID";
	$result_img = mysql_query($sql_img,$connect);
	$number=mysql_num_rows($result_img);
	if($number>0)
	{
		if($result_img)
		{
			
			while($row_img = mysql_fetch_array($result_img))
			{	
				
				$imgName = $row_img['images'] ; //ten file can xoa
				if($imgName!='')
				{
					$myFile = "C:/AppServ/www/NOITHAT/image/$imgName";
					unlink($myFile); //ham xoa Image
				}
			}
		}
		else
		{
			echo "<script> alert('Ảnh sản phẩm chưa xóa được'); </script>";
		}
	}	
	else
	{
		echo "<script> alert(' Lỗi ảnh sản phẩm chưa xóa được'); </script>";
	}
	// Xoa trong bang product
	$sql_del_prospec ="DELETE FROM product_category WHERE proID = $proID"; 
	mysql_query($sql_del_prospec);
	$sql_xoa = "Delete From product Where proID = $proID";
	mysql_query($sql_xoa);

	
	//Xoa cac thuoc tinh trong att_product
	$sql_attproduct="delete from att_product where proID=$proID";
	$result_attproduct=mysql_query($sql_attproduct);
	if($result_attproduct)
	{
		
	}
	// Xoa cac feedback
	$sql_feedback="delete from feedback where proID=".$proID;
	$result_feedback=mysql_query($sql_feedback,$connect);
	echo("<script>window.location='admin.php?go=product_list';</script>");
}



if($action=="change")
{
	$sql_update="Update product set status=".$_REQUEST['status']." where proID=".$_REQUEST['proID'];
	if(mysql_query($sql_update))
	{
		echo("<script>window.location='admin.php?go=product_list';</script>");	
	}
}

?>
