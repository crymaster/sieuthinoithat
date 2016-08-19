<?php
	$gpCate=$_REQUEST['gpCateID'];
	$gpCateNew=$_REQUEST['gpCateNew'];
	
	// Phan duoi ta phai cung cap index.php
?>
<script>
	function checksearch1()
	{
		$price=document.getElementById('price');
		if($price.value==0)
		{
			alert("Bạn chưa chọn khoảng giá tìm kiếm");
			return false;
			
		}
	}	
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<form method="post" name="frmsearchadvanced" id="frmsearchadvanced" action="index.php?go=temp" onSubmit="return checksearch1();">
<table class="borderAllTable" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="3%" bgcolor="#FF0000"></td>
<td width="97%" align="center" class="title" >TÌM NHANH SẢN PHẨM</td>
</tr>
<tr>
<td colspan="2" valign="top"><table width="100%" border="0" align="center"   cellspacing="9"class="backgroundTable style1"   >


<tr >
	<td align="center"><select name="group_category"  id="group_category" style="width:100%" onchange="location.href='index.php?go=product_list&gpCateID=<?php echo($gpCate)?>&gpCateNew='+this.value">
	<option value="0">-Tất cả dòng sản phẩm-</option>
	<?php
	// chon loai san pham
		$sql_gp = "select * from group_category where status=1";
		$resuilt_gp = mysql_query($sql_gp,$connect);
	?>
	<?php while($row=mysql_fetch_array($resuilt_gp))
	{
	?>
		<?php
			if($row['gpCateID']==$gpCateNew)
			{
			?>
				<option value="<?php echo $row['gpCateID'];?>" selected="selected"><?php echo $row['gpCateName'];?></option>
		<?php	}
			else
			{
		?>
				<option value="<?php echo $row['gpCateID'];?>"><?php echo $row['gpCateName'];?></option>
	<?php } } ?>
	</select></td>
</tr>


<tr >
<td align="center"><select name="category" id="category"  style="width:100%" >
<?php
	//chon loai sản phẩm
	$sql_cate="Select * from category where status=1 and gpCateID=".$gpCateNew;
	$resuilt_cate=mysql_query($sql_cate,$connect);

?>
	<option value="0" >-Tất cả loại sản phẩm-</option>
	<?php
	while($row_cate=mysql_fetch_array($resuilt_cate))
	{
	?>
		<option value="<?php echo $row_cate['cateID'];?>"><?php echo $row_cate['cateName'];?></option>
	<?php  }?>
	</select></td>
</tr>

<tr>
	
	<td align="center"><select name="supplier"  id="supplier" style="width:100%">
	<option value="0">-Tất cả nhà sản xuất-</option>
	<?php
	
		$sql_sup = "select * from supplier where status=1";
		$resuilt_sup = mysql_query($sql_sup,$connect);
	?>
	<?php while($row=mysql_fetch_array($resuilt_sup))
	{
	?>
		<option value="<?php echo $row['subID'];?>"><?php echo $row['subName'];?></option>
	<?php } ?>
	</select>	</td>
</tr>



<tr>
	<td align="center"><select name="price" id="price" style="width:100%">
							
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
					?>
						<option value="<?php echo $row_price['seaID']; ?>"><?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).'VNĐ'; ?> </option>
					<?php	
						}
						else
						{
					?>	
					<option value="<?php echo $row_price['seaID']; ?>"> <?php echo 'Lớn hơn '.number_format($row_price['fromPrice']).' VNĐ Nhỏ hơn '.number_format($row_price['toPrice']).' VNĐ'; 									?></option>
				<?php } }?>
		</select>	</td>
</tr>
<tr>
	<td align="center"><input type="submit" name="Submit" value="Xem kết quả" /></td>
</tr>
</table></td>
</tr>
</table>
</form>
