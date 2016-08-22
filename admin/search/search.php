<script>
function checkSearchAdmin()
{
	var gia=document.getElementById('price');
	if(gia.value==0)
	{
		alert("Bạn chưa chọn khoảng giá !");
		return false;
	}
	return true;
}	
</script>
<?php 
$page="admin.php?go=search&action=search";
$record_per_page = 15;
	$pagenum = $_REQUEST["page"];
	$action=$_REQUEST['action'];

$totalpage = 0;
if($action=="search")
{
	$gpCateID=$_REQUEST["gpCateID"];
	$IDprice=$_REQUEST['price'];
	$category=$_REQUEST['category'];
	$supplier=$_REQUEST['supplier'];
	$group_category=$_REQUEST['group_category'];
	
	$expression=" 1 ";
		
		if($category != 0)
		{
			$expression =$expression." and category.cateID =".$category;
			$page =$page."&category=".$category;
		}
		else
		{
			if($group_category==0)
			{
			}
			else
			{
				$expression =$expression." and category.gpCateID =".$group_category;
			}	
		}
		if($supplier != 0)
		{
			$expression =$expression." and supplier.subID =".$supplier;
			$page =$page."&supplier=".$supplier;
		}
		
		// Tìm khoảng giá yêu cầu
		
		$sql_maxprice="select max(seaID) as maxID from search";
		$result_maxprice=mysql_query($sql_maxprice,$connect);
		while($row_maxprice=mysql_fetch_array($result_maxprice))
		{
			$check=$row_maxprice['maxID'];
		}
		$sql_price="select * from search where seaID=".$IDprice;
		$result_fromto=mysql_query($sql_price,$connect);
		if($result_fromto)
		{
			while($row_fromto=mysql_fetch_array($result_fromto))
			{
				if($row_fromto['seaID']==$check)
				{
					$fromprice=$row_fromto['fromPrice'];
					$toprice=0;
				}
				else
				{
					$fromprice=$row_fromto['fromPrice'];
					$toprice=$row_fromto['toPrice'];
				}
			}
			if($toprice==0)
			{
				$expression =$expression." and product.priceSale > ".$fromprice;
			}
			else
			{
				$expression =$expression." and product.priceSale > ".$fromprice;
				$expression =$expression." and product.priceSale < ".$toprice;
			}
			
		}
		
		?>
		
		<?php
		$sql_sum = "SELECT  product.*   
		FROM         category INNER JOIN
		product_category ON category.cateID = product_category.cateID INNER JOIN product ON product_category.proID=product.proID INNER JOIN
		supplier ON product.subID=supplier.subID Where " .$expression." Order By product.postTime DESC" ;
		//echo $sql_sum; 
		?>
			<?php
		
		$resuilt_sum=mysql_query($sql_sum,$connect);
		if($resuilt_sum)
		{
			$totalpage =ceil( mysql_num_rows($resuilt_sum) / $record_per_page);
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
			$sql_sum1 =$sql_sum." LIMIT ".$from.",".$record_per_page;
			
		//	echo $sql_sum1;
		}
		
}


?>


<form action="?go=search&action=search&page=<?php echo $pagenum;?>" method="post" name="frmadd" id="frmadd" onSubmit="return checkSearchAdmin()">

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" background="../media/banner_l.jpg" align="center" colspan="8"><span class="style1">TÌM KIẾM SẢN PHẨM </span></td>
</tr>
<tr>
<td class="row" width="40%" align="right" colspan="4">Loại sản phẩm </td>
<td class="row" width="60%" align="left" colspan="4"><label>

<?php
$sql="Select * from group_category";
$resuilt=mysql_query($sql,$connect);

?>
<select name="group_category" id="group_category">
<option value="0" >--Chọn loại sản phẩm--</option>
<?php
while($row=mysql_fetch_array($resuilt))
{
	if((isset($group_category) && $row['gpCateID']==$group_category) || (isset($gpCateID) &&$row['gpCateID']==$gpCateID )){
?>
	
<option value="<?php echo $row['gpCateID']; ?>" selected="selected"><?php echo $row['gpCateName']; ?></option>
<?php }
	else{?>
		<option value="<?php echo $row['gpCateID']; ?>" ><?php echo $row['gpCateName']; ?></option>
<?php	}
	
}?>

</select>
</label></td>
</tr>

<tr>
<td class="row" align="right" colspan="4">Chọn dòng sản phẩm</td>
<td class="row" align="left" colspan="4"><label>
<?php
		$where = 'WHERE 1=1';
		if (isset($gpCateID)) {
			$where = $where . 'AND gpCateID='.$gpCateID;
		}
		if (isset($group_category)) {
			$where = $where . ' AND gpCateID='.$group_category;
		}
		$sql1="select*from category $where";
		$resuilt1=mysql_query($sql1,$connect);
?>
	<select name="category" id="category">
	<option value="0">--Chọn dòng sản phẩm--</option>
	<?php
		while($row1=mysql_fetch_array($resuilt1)) {
		if(isset($category) && $row1['cateID']==$category){?>
		<option value="<?php echo $row1['cateID'] ?>" selected="selected"> <?php echo $row1['cateName'] ?></option>
	<?php
	} else { ?>
		<option value="<?php echo $row1['cateID'] ?>" > <?php echo $row1['cateName'] ?></option>
	<?php } }
	?>
	</select>
</label></td>
</tr>
<tr>
<td class="row" align="right" colspan="4">Chọn nhà sản xuất </td>
<td class="row" align="left" colspan="4"><label>
<?php
	$sql2="select * from supplier";
	$resuilt2=mysql_query($sql2,$connect);
?>
	<select name="supplier" id="supplier">
	<option value="0">--Chọn nhà sản xuất</option>
	<?php
		while($row2=mysql_fetch_array($resuilt2)) {
			if(isset($supplier) && $row2['subID']==$supplier)
			{?>
				<option value="<?php echo $row2['subID'];?>" selected="selected"><?php echo $row2['subName']?></option>
		<?php	}
		else {
	?>
		<option value="<?php echo $row2['subID']?>"> <?php echo $row2['subName']?></option>
		<?php } }?>
		</select>
</label></td>
</tr>
<tr>
<td class="row" align="right" colspan="4">Chọn khoảng giá </td>
<td class="row" align="left" colspan="4"><label>
	<select name="price" id="price" style="width:100%">
							
		<?php
			// Chọn các khoảng giá cả cho hợp lý
			$sql_price="select * from search ";
			$result_price=mysql_query($sql_price,$connect);
			$sql_maxprice="select max(seaID) as maxID from search";
			$result_maxprice=mysql_query($sql_maxprice,$connect);
			while($row_maxprice=mysql_fetch_array($result_maxprice))
			{
				$check=$row_maxprice['maxID'];
			}
			?>
			<option value="0">-Tất cả các giá-</option>
			<?php
			while($row_price=mysql_fetch_array($result_price))
				{
					if($row_price['seaID']==$check)
					{
						if(isset($IDprice) && $row_price['seaID']==$IDprice) {
					?>
						<option value="<?php echo $row_price['seaID']; ?>" selected="selected"><?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).'VNĐ'; ?> </option>
					<?php	
					}
					else {
					?>
						<option value="<?php echo $row_price['seaID']; ?>"><?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).'VNĐ'; ?> </option>
				<?php	}
					
					}
						else
						{
							if(isset($IDprice) && $row_price['seaID']==$IDprice) {
					?>	
					<option value="<?php echo $row_price['seaID']; ?>" selected="selected"> <?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).' VNĐ Nhỏ hơn '.number_format($row_price['toPrice']).' VNĐ'; 									?></option>
				<?php }
					else
					{ ?>
						<option value="<?php echo $row_price['seaID']; ?>"> <?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).' VNĐ Nhỏ hơn '.number_format($row_price['toPrice']).' VNĐ'; 									?></option>
			<?php	} } }?>
		</select>
</label></td>
</tr>
<tr>
<td class="row" colspan="8" align="center"><label>
<input type="submit" name="Submit" value="Tìm Kiếm">
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
	if(isset($sql_sum1)) {
		$resuilt_fn=mysql_query($sql_sum1,$connect);
	}
	if(isset($resuilt_fn) && $resuilt_fn)
	{ ?>
	<tr>
		<td class="row" align="center" colspan="8"> Số sản phẩm tìm thấy là:<b style="color:#FF0000"> <?php echo mysql_num_rows($resuilt_sum)  ?></b></td>
	</tr>
	<?php
			while($row_fn = mysql_fetch_array($resuilt_fn))
			{
					?>
					<tr onMouseOver="this.className='over'" onMouseOut="this.className='out'" class="out">
					<td class="row" align="center"><label></label>    <?php echo $row_fn['proID'];?></td>
					<td class="row" align="center">
					<a href="admin.php?go=product_edit&action=update&proID=<?php echo $row_fn['proID'];?>">
					<img  height="50" width="60"src="../image/<?php echo $row_fn['images'];?> " /></a></td>
					<td class="row" align="center"><?php echo $row_fn['proName'];?></td>
					<td class="row" align="center"><?php echo(number_format($row_fn['priceSale']));?> VND</td>
					<td class="row" align="center"><?php echo $row_fn['postTime'];?></td>
					<td align="center" class="row">
					<select name="proStatus" onchange="location.href='admin.php?go=product_list&action=change&proID=<?php echo $row_fn['proID'];?>&status='+this.value;">
					<?php if($row_fn['status']==1) {?>
					<option value="1">Hiện</option>
					<option value="0">Ẩn</option>
					<?php } else {?>
					
					<option value="0">Ẩn</option>
					<option value="1">Hiện</option>
					</select><?php }?>	</td>
					<td class="row" width="6%" align="center"><a href="admin.php?go=product_edit&action=update&proID=<?php echo $row_fn['proID'];?>">Sửa</a></td>
					<td class="row" width="6%" align="center">
					
					<?php
					// Chu y o day neu neu san pham co trong orderdetail thi khong duoc xoa san pham
					$sql_check="Select * from orderdetail where proID=".$row_fn['proID'];
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
					
					
						<a href="admin.php?go=product_list&action=del&proID=<?php echo $row_fn['proID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>	   <?php }?></td>
					</tr>
<?php } }?> 
</table>
</form>
<?php
/*
Vong lap de tao ra cac link lien ket den cac trang du lieu.
Output: 	1 | 2 | 3 | 4 
*/

for($i =1; $i<=$totalpage;$i++)
{
	if ($i==1){
		$page1=$page."&price=".$IDprice."&category=".$category."&supplier=".$supplier."&group_category=".$group_category;
		echo "<a href='".$page1."&page=".$i."' >".$i."</a>"	;	
	}else{
	$page1=$page."&price=".$IDprice."&category=".$category."&supplier=".$supplier."&group_category=".$group_category;
	if($pagenum==$i) {			
		echo " | <a href='".$page1."&page=".$i."'><B><font color=red><u>".$i."</u></font></B></a>";
		} else {
		echo " | <a href='".$page1."&page=".$i."'>".$i."</a>";
	} }
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
