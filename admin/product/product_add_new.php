<?php
// Dung de tu loai san pham ta lay duoc dong san pham
		
		//$gpCate=$_REQUEST['gpCate'];
		if($gpCate==0)
		{
			$sqlCateName="select * from categoty order by cateID";
		}
		else
		{
			$sqlCateName="select * from category where gpCateID='".$gpCate."'";
		}
		$resuiltModName = mysql_query($sqlCateName,$connect);
	
?>
<script>
	function CheckFormProAdd11()
	{
		//alert();
		var group_category=document.getElementById('group_category');
		var modID=document.getElementById('modID');
		var supplier=document.getElementById('supplier');
		var proName=document.getElementById('proName');
		var proDescription=document.getElementById('proDescription');
		var proPrice=document.getElementById('proPrice');
		var salePrice=document.getElementById('salePrice');
		var proQuantity=document.getElementById('proQuantity');
		var reg=/^[0-9]+$/;
		//alert(proQuantity.value);
		if(group_category.value==0)
		{
			alert("Bạn phải chọn loại sản phẩm !");
			group_category.focus();
			return false;
		}
		if(modID.value==0)
		{
			alert("Bạn phải chọn dòng sản phẩm ! ");
			modID.focus();
			return false;
		}
		 if(supplier.value==0)
		{
			alert("Bạn phải chọn nhà sản xuất !");
			supplier.focus();
			return false;
		}
		 if(proName.value=="")
		{
			alert("Tên sản phẩm không được để trống !");
			proName.focus();
			return false;
		}
		if(proDescription.value=="")
		{
			alert("Mô tả sản phẩm không được để trống !");
			proDescription.focus();
			return false;
		}
		 
		if(!reg.test(proPrice.value))
		{
			alert("Giá nhập sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proPrice.focus();
			return false;
		}
		if(!reg.test(salePrice.value))
		{
			alert("Giá bán sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			salePrice.focus();
			return false;
		}
		if(!reg.test(proQuantity.value))
		{
			alert("Số lượng sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proQuantity.focus();
			return false;
		}
		if(eval(proPrice.value)<=0)
		{
			alert("Giá nhập sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proPrice.focus();
			return false;
		}
		if(eval(salePrice.value)<=0)
		{
			alert("Giá bán sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			salePrice.focus();
			return false;
		}
		if(eval(proQuantity.value)<=0)
		{
			alert("Số lượng sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proQuantity.focus();
			return false;
		}
		if(eval(proPrice.value)-floor(eval(proPrice.value)) != 0)
		{
			alert("Giá nhập sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proPrice.focus();
			return false;
		}
		if(eval(salePrice.value)-floor(eval(salePrice.value)) != 0)
		{
			alert("Giá bán sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			salePrice.focus();
			return false;
		}
		if(eval(proQuantity.value)-floor(eval(proQuantity.value)) != 0)
		{
			alert("Số lượng sản phẩm không đúng phải lớn hơn 0 và là số nguyên !");
			proQuantity.focus();
			return false;
		}
		return true;
	}
</script>
<form  action="admin.php?go=product_add_process&action=add" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd" onsubmit="return CheckFormProAdd11()">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="50">
			<table width="100%" border="0" cellspacing="3" cellpadding="3" >
				<tr>
					<td height="50" colspan="3" align="center" background="../media/banner_l.jpg"><span class="style1">THÊM MỚI SẢN PHẨM </span></td>
				</tr>
				<tr>
					<td class="row" width="40%" align="right">Loại sản phẩm </td>
					<td class="row" width="30%">
					<select name="group_category" id="group_category" style="width:200px" onchange="location.href='admin.php?go=product_add_new&gpCate='+this.value">
						<?php
							// Lay cac gpCateID để chọn dòng sản phẩm muốn thêm vào cơ sở dữ liệu
							$sql_gpcate="select * from group_category";
							$result_gpcate=mysql_query($sql_gpcate,$connect);
						?>
					<option value="0">-Tất cả các dòng sản phẩm-</option>
						<?php
						
						while($row_gpcate=mysql_fetch_array($result_gpcate))
						{
							if($row_gpcate['gpCateID']==$gpCate)
							{
							?>
							<option value=" <?php echo $row_gpcate['gpCateID'];?> " selected="selected"><?php echo $row_gpcate['gpCateName'];?></option>
							<?php } else { ?>
							<option value="<?php echo $row_gpcate['gpCateID'];?>" ><?php echo $row_gpcate['gpCateName'];?></option>
							<?php } } ?>
					</select> </td>
					<td class="row" width="30%" align="center">Ảnh đại diện </td>
				</tr>
				<tr>
					<td class="row" width="40%" align="right">Dòng sản phẩm: </td>
					<td class="row" width="30%">
					<select name="modID" id="modID">
						<option value="0">-Chọn dòng sản phẩm-</option>
						<?php if($resuiltModName)
						 {
						 	while($rowModName=mysql_fetch_array($resuiltModName))  {    ?>
						<option value="<?php echo $rowModName['cateID'];?>"><?php echo $rowModName['cateName'];?></option>
						<?php } }?>
					</select></td>
					<td class="row" rowspan="7" align="center" valign="middle">
	
						<input name="txtanh" type="text" value="<?php=$anh?>" size="40" />
							<input name="upload" type="button" id="upload" value="Upload" onclick="window.open('upload.php?Thumuc=../image&form=frmadd&input=txtanh&anh=AnhSP','','width=400,height=200');"/>
	<p><img name="AnhSP" id="AnhSP" src="../image/<?php=$anh?>" width="200" height="200" alt="" /></p>		</td>
	
				<tr>
					<td class="row" width="40%" align="right">Nhà Cung cấp </td>
					<td class="row" width="30%">
						<select name="supplier" id="supplier" style="width:200px">     
						<?php
							// Chú ý sID ở đây có tác dụng là lấy và insert vào trong bảng product
							$sql_sup="Select * from supplier";
							$resuilt_sup=mysql_query($sql_sup,$connect);
	
						?>
						<option value="0" >-Tất cả nhà sản xuất-</option>
						<?php
							while($row_sup=mysql_fetch_array($resuilt_sup))
							{
								?><option value="<?php echo $row_sup['subID'];?>"><?php echo $row_sup['subName'];?></option>
							<?php   }?>
						</select></td>
						
					
				</tr>
				
				<tr>
					<td align="right" class="row">Tên sản phẩm:</td>
					<td class="row"><input name="proName"  id="proName"type="text" size="45" /></td>
				</tr>
	
				<tr>
					<td  class="row" align="right">Mô tả: </td>
					<td class="row"><textarea name="proDescription" id="proDescription" cols="35" rows="3"></textarea></td>
				</tr>
				
				<tr>
					<td class="row" align="right">Giá nhập:</td>
					<td class="row"><input name="proPrice" id="proPrice" type="text" size="30" />VNĐ</td>
				</tr>
				<tr>
					<td class="row" align="right">Giá bán:</td>
					<td class="row">
					  <input name="salePrice" type="text" id="salePrice" size="30"  onblur="checkGiaBan();" />VNĐ
					</td>
				</tr>
				
				
				
				<tr>
					<td class="row" align="right">Trạng thái </td>
					<td class="row"><select name="proStatus" id="proStatus">
						<option value="1">Hiện</option>
						<option value="0">Ẩn</option>
						</select></td>
				</tr>
				
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
				<tr>
					<td class="title">THÔNG SỐ THUỘC TÍNH CHO SẢN PHẨM</td>
				</tr>
				<tr>
					<?php
					$sql_spec="select * from attribute where status = 1";
					$re_spec= mysql_query($sql_spec,$connect);
					if($re_spec)
					{
					while($rown = mysql_fetch_array($re_spec))
					{
					?>
					
						
							<tr>
								<td class="row" width="40%" align="right"><?php echo($rown['attName']);?></td>
								<td class="row" align="left"><input  name="txt<?php=$rown['attID']?>" type="text" size="30"/></td>
							</tr>
						
					
					
						<?php
						}
						}
						?>
						
				</tr>
			</table>
		</td>
	</tr>
</table>
  <div align="center">
    <input type="submit" name="Submit" value="Thêm mới" />
    <input type="reset" name="Submit2" value="Nhập lại" />
  </div>
</form>
