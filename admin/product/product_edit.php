<?php
require'Upload_images/upload.class.inheritance.php';
$action=$_REQUEST['action']; 
$proID=$_REQUEST['proID']; //request mã proID của sản phẩm cần sửa từ link của product_list.php

if($action=='update') //ACTION HIEN THI THONG TIN SAN PHAM KHI VAO TRANG SUA
{
	//$proID=$_REQUEST['proID'];
	$sql_pro="select * from product where proID=".$proID;
	$result_pro = mysql_query($sql_pro,$connect);
	$row_pro = mysql_fetch_array($result_pro);
	
}

if($action=='edit')//ACTION SAU KHI CAP NHAT LAI TOAN BO FORM
{

	$proName=$_REQUEST['proName'];
	$modID = $_REQUEST['modID'];
	$proImage = $_REQUEST['txtanh'];
	$proDescription=$_REQUEST['proDescription'];
	$proSale = $_REQUEST['salePrice'];
	$proPrice=$_REQUEST['proPrice'];
	$proQuantity=$_REQUEST['proQuantity'];
	$proStatus=$_REQUEST['proStatus'];  
	if($proImage=="")
	{
		//tạo câu lệnh update sản phẩm có mã proID từ link SỬA của product_list.php
		$sql_edit="Update product Set proName='$proName',proDes='$proDescription',
		priceSale='$proSale', postTime=NOW(),status=$proStatus, price=$proPrice
		 where proID=".$proID;
		}else{
		$sql_edit="Update product Set proName='$proName',
		proDes='$proDescription', priceSale='$proSale',
		postTime=NOW(),images='$proImage', status=$proStatus, price=$proPrice  where proID=".$proID;
		// Thực hiện việc xóa ảnh củ đi
		
		$sql_img = "select * from product WHERE proID = ".$proID;
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
			echo "<script> window.location = 'admin.php?go=product_edit'; </script>";
		}
	}

		$success = mysql_query($sql_edit,$connect);
		if($success) //nếu thực thi câu lệnh thành công thi:
		{	
		// Thuc hien update trong bang product_category
			$sql_proCategory = "update product_category set cateID = $modID where proID=".$proID;
			$resultProCate = mysql_query($sql_proCategory,$connect);
			if(!$resultProCate)
			{
				echo "<script> alert('Lỗi không update dòng sản phẩm'); </script>";
				echo "<script> window.location = 'admin.php?go=product_edit'; </script>";
			}
			$sql_spec = "select * from att_product";
			$re_spec = mysql_query($sql_spec);
		//tạo câu lệnh và vòng lặp lấy lần lượt mã specID
			if($re_spec)
			{
		//UPDATE THONG SO KY THUAT
				while($rown = mysql_fetch_array($re_spec))
				{	
			
					$specID = $rown['attID'];
					$detail = $_REQUEST["txtck".$specID];
				
				
					//trong vòng lặp thực hiên câu lênh update psContent với mã proID và mã specID theo thứ tự
					$sql_prospec = "Update  att_product Set  att_value='$detail' where proID=$proID and attID=$specID";
					mysql_query($sql_prospec);
				}	//echo $sql_prospec; echo "<br />";
			}
			else
			{
				echo "<script> alert('Lỗi không update thông số sản phẩm'); </script>";
				echo "<script> window.location = 'admin.php?go=product_edit'; </script>";
			}
		}
	?>
	<script language="javascript">
	alert("Đã cập nhật thành công");
	window.location.href='admin.php?go=product_list';
	</script>
	<?php
}
?>
<?php
/*else
{
	echo("<script> alert('Cập nhật không thành công');</script>");
	echo("<script>window.location='admin.php?go=product_list';</script>");	
}
*/
?>
<script>
	function CheckFormProAdd11()
	{
		//alert();
		//var group_category=document.getElementById('group_category');
		var modID=document.getElementById('modID');
		//var supplier=document.getElementById('supplier');
		var proName=document.getElementById('proName');
		var proDescription=document.getElementById('proDescription');
		var proPrice=document.getElementById('proPrice');
		var salePrice=document.getElementById('salePrice');
		var proQuantity=document.getElementById('proQuantity');
		var reg=/^[0-9]+$/;
		//alert(proQuantity.value);
		/*if(group_category.value==0)
		{
			alert("Bạn phải chọn loại sản phẩm !");
			group_category.focus();
			return false;
		}*/
		if(modID.value==0)
		{
			alert("Bạn phải chọn dòng sản phẩm ! ");
			modID.focus();
			return false;
		}
		/* if(supplier.value==0)
		{
			alert("Bạn phải chọn nhà sản xuất !");
			supplier.focus();
			return false;
		}*/
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
<form action="admin.php?go=product_edit&action=edit&proID=<?php echo($row_pro['proID']);?>" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd" onsubmit="return CheckFormProAdd11();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="50">
<!--------PRODUCT--------->
		<table width="100%" border="0" cellspacing="3" cellpadding="3" >
		<tr>
		<td height="50" colspan="3" align="center" background="../media/banner_l.jpg">
		<span class="style1">CHỈNH SỬA SẢN PHẨM</span>		</td>
		</tr>
		<tr>
		<td class="row" width="40%" align="right">Tên sản phẩm: </td>
		<td class="row" width="30%" align="left">
		<input name="proName"  id="proName"type="text" size="45" value="<?php echo($row_pro['proName']);?>" /></td>
		<td class="row" width="30%" rowspan="8" align="center" valign="top"><p>Ảnh thay thế </p>
		<input name="txtanh" type="text" value="<?php=$anh?>" size="40" />
		<input name="upload" type="button" id="upload" value="Upload" 
		onClick="window.open('upload.php?Thumuc=../image&form=frmadd&input=txtanh&anh=AnhSP','','width=400,height=200');"/>
		<p><img name="AnhSP" id="AnhSP" src="../picture/<?php=$anh?>" width="200" height="200" alt="" /></p></td>
		</tr>
		<tr>
		<td class="row" align="right">Ảnh:</td>
		<td class="row" align="left"><img  height="75"  border="0" width="90"src="../image/<?php echo $row_pro['images'];?> " /></td>
		</tr>
		<tr>
		<td width="40%" align="right" class="row">Dòng sản phẩm: </td>
		<td align="left" class="row"><select name="modID" id="modID">
		<!--echo mã modID của  sản phẩm nhưng hiển thị dưới dạng tên -->
		<?php
		$sql = "select category.cateID,category.cateName from  product INNER JOIN product_category ON product.proID = product_category.proID INNER JOIN category ON product_category.cateID = category.cateID 
		 where product.proID =".$row_pro['proID'];
		$result=mysql_query($sql,$connect);
		$row_modName=mysql_fetch_array($result);
		
		?>
		<option value="<?php echo $row_modName['cateID'];?>"><?php echo $row_modName['cateName'];?></option>
		<?php
		$sql="Select * from category";
		$resuilt=mysql_query($sql);
		?>
		<?php
		while($row=mysql_fetch_array($resuilt))
		{
			if($row['cateID'] != $row_modName['cateID'] )
				{
				?>
			<option value="<?php echo $row['cateID']; ?>"><?php echo $row['cateName']; ?></option>
			<?php } }?>
		</select>		</td>
		</tr>
		
		<tr>
		<td class="row" align="right">Mô tả: </td>
		<td class="row" align="left">
		<textarea name="proDescription" id="proDescription" cols="35" rows="3"><?php echo($row_pro['proDes']);?></textarea></td>
		</tr>
		<tr>
		<td class="row" align="right">Giá:</td>
		<td class="row" align="left"><input name="proPrice" id="proPrice" value="<?php echo(floatval($row_pro['price']));?>" type="text" size="30" />
		<br />
		(<?php echo(number_format($row_pro['price']));?> VND)</td>
		</tr>
		<tr>
		<td class="row" align="right">Giá bán : </td>
		<td class="row" align="left">
		<input  value="<?php echo(floatval($row_pro['priceSale']));?>"name="salePrice" id="salePrice" type="text" size="30" />VNĐ</td>
		</tr>
		
		<tr>
		<td class="row" align="right">Trạng thái </td>
		<td class="row" align="left"><select name="proStatus" id="proStatus">
		<?php if($row_pro['status']==1) {?>
		<option value="1">Hiện</option>
		<option value="0">Ẩn</option>
		<?php } else {?>
		<option value="0">Ẩn</option>
		<option value="1">Hiện</option>
		<?php }?>
		</select>		</td>
		</tr>
		</table>
<!--------------END PRODUCT------------>
</td>
</tr>
	
	

	



<tr>
<td>
		<!-----------SPEC------>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td class="title">THÔNG SỐ KỸ THUẬT </td>
		</tr>
		<tr>
		<?php	
		$sql = "SELECT  att_product.attID,att_product.att_value,attribute.attName from attribute INNER JOIN att_product ON attribute.attID=att_product.attID INNER JOIN product on att_product.proID=product.proID where product.proID=".$proID;
		$qr = mysql_query($sql);
		$i=0;
		while($rown = mysql_fetch_array($qr))
		{
		//$psContent = $row['psContent'];
		?>
		<td class="row">
				<table width="100%" border="0" cellspacing="1" cellpadding="1">
				<tr>
				<td class="row" width="40%" align="right"><?php echo($rown['attName']);?></td>
				<td class="row" align="left">
				<input  name="txtck<?php=$rown['attID']?>" type="text"  value="<?php echo($rown['att_value']);?>"size="45"/>
				</td>
				</tr>
				</table>
		</td>
		<?php
		$i++;
		if($i%2==0)
		echo("</tr>");
		?>
		<?php
		}
		?>
		<?php
		if($i%2!=0)
		echo("</tr>");
		?>
		</tr>
		</table>
		
		<!-----END SPEC------>
		
</td>
</tr>
</table>
  <div align="center">
    <input type="submit" name="Submit" value="Cập nhật" />
    <input type="button" name="Submit2" value="Quay lại"  onClick="location.href='admin.php?go=product_list'"/>
    <label>
    <input type="reset" name="Submit3" value="Reset" />
    </label>
  </div>
</form>

