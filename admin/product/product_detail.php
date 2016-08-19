<?php
require'Upload_images/upload.class.inheritance.php';
$action=$_REQUEST['action']; 
$proID=$_REQUEST['proID']; //request mã proID của sản phẩm cần sửa từ link của product_list.php


$proID=$_REQUEST['proID'];
$sql_pro="select * from product where proID=".$proID;
$result_pro = mysql_query($sql_pro,$connect);
$row_pro = mysql_fetch_array($result_pro);






if($action=='delete_img') //XOA ẢNH TINH NANG SAN PHAM
{
$proID=$_REQUEST['proID'];
$imgID=$_REQUEST['imgID'];

//Xoa file Anh trong thu muc :: image_product_detail
$sql_img = "select * from image where imgID = $imgID";
$result_img = mysql_query($sql_img,$connect);
$row_img = mysql_fetch_array($result_img);	
$imgName = $row_img["imgUrl"] ; //ten file can xoa
$myFile = "image_product_detail/$imgName";
unlink($myFile); //ham xoa Image	

//echo "Xoa Iamage co: proID=".$proID;echo "Xoa Iamage co: imgID=".$imgID;
$sql_deleteImg = "Delete From image Where imgID=$imgID";
$re_deleteImg = mysql_query($sql_deleteImg);
	
?>
<script language="javascript">
alert("Đã xóa ảnh");
window.location.href='admin.php?go=product_edit&action=update&proID=<?php echo $proID?>';
</script>
<?php
}	




if($action=='delete_img_color') //XOA ẢNH DAI DIEN CHO MAU SAN PHAM
{
$proID=$_REQUEST['proID'];
$colorID=$_REQUEST['colorID'];

//Xoa file Anh trong thu muc :: image_product_detail
$sql_procolor = "select * from procolor where colorID = $colorID and proID = $proID";
$result_color = mysql_query($sql_procolor,$connect);
$row_procolor = mysql_fetch_array($result_color);	
$Img = $row_procolor["Img"] ; //ten file can xoa
$myFile = "image_product_detail/$Img";
unlink($myFile); //ham xoa Image

//echo "Xoa Iamage co: proID=".$proID;echo "Xoa Iamage co: imgID=".$imgID; die();
//thuc chat la thay doi gia tri cua Img = " "
$sql_deleteImg = "UPDATE procolor set Img='' Where proID=$proID and colorID=$colorID";
$re_deleteImg = mysql_query($sql_deleteImg);

?>
<script language="javascript">
alert("Đã xóa ảnh");
window.location.href='admin.php?go=product_edit&action=update&proID=<?php echo $proID?>';
</script>
<?php	
}





if($action=='edit')//ACTION SAU KHI CAP NHAT LAI TOAN BO FORM
{

//UPDATE TÌNH NĂNG SAN PHAM
$sql_img="select * from image where proID=".$_REQUEST['proID']." order by imgID Desc";
$result_img = mysql_query($sql_img,$connect);

while($row_img = mysql_fetch_array($result_img))
{
$imgID = $row_img["imgID"];
$title = $_REQUEST["title".$imgID];
$comment = $_REQUEST["text".$imgID];
//echo $title."<br>";echo $text."<br>";echo $status."<br>";echo "<hr/>";

$upload = new Upload_insert("img".$imgID); 
/*	echo "THONG TIN DOI TUONG UPLOAD KHI DUOC KHOI TAO(image$i)";
echo "<pre>";
print_r($upload);
echo "<pre>";*/

$upload->setUploadDir('image_product_detail/'); //thu muc ben ngoai admin
$upload->checkFileSize(1000);
$upload->checkFileType('gif|jpg|png'); 

if($upload->isVail() == false){ //neu khoi tao dc doi tuong,thi goi hàm update ảnh moi
$upload->upload_Update($comment,$title,$imgID) ;
}
else{
/*echo "<pre>";
print_r($upload->_errors);
echo "<pre>";
Chi thay doi gia tri cua imgtitle,comment,status
*/
$sql = "UPDATE image SET imgTitle='$title',imgComment = '$comment' Where imgID=$imgID";
mysql_query($sql);
}

} 
/////////////////////END////////////////////////////


$proName=$_REQUEST['proName'];
$modID = $_REQUEST['modID'];
$proImage = $_REQUEST['txtanh'];
$proDescription=$_REQUEST['proDescription'];
$proWarranty = $_REQUEST['proWarranty'];
$proPrice=$_REQUEST['proPrice'];
$proQuantity=$_REQUEST['proQuantity'];
$proStatus=$_REQUEST['proStatus'];  

if($proImage=="")
{
//tạo câu lệnh update sản phẩm có mã proID từ link SỬA của product_list.php
$sql_edit="Update product Set proName='$proName', modID=$modID,proDescription='$proDescription',
proWarranty='$proWarranty', proDate=NOW(),proStatus=$proStatus, proPrice=$proPrice,
proQuantity=$proQuantity  where proID=".$proID;
}else{
$sql_edit="Update product Set proName='$proName', modID=$modID,
proDescription='$proDescription', proWarranty='$proWarranty',
proDate=NOW(),proImage='$proImage', proStatus=$proStatus, proPrice=$proPrice, proQuantity=$proQuantity  where proID=".$proID;
}

$success = mysql_query($sql_edit,$connect);

if($success) //nếu thực thi câu lệnh thành công thi:
{	
$sql_spec = "select * from specifications";
$re_spec = mysql_query($sql_spec);
//tạo câu lệnh và vòng lặp lấy lần lượt mã specID

//UPDATE THONG SO KY THUAT
while($rown = mysql_fetch_array($re_spec))
{	

$specID = $rown[specID];
$detail = $_REQUEST["txtck".$specID];


//trong vòng lặp thực hiên câu lênh update psContent với mã proID và mã specID theo thứ tự
$sql_prospec = "Update  prospec Set  psContent='$detail' where proID=$proID and specID=$specID";
mysql_query($sql_prospec);
//echo $sql_prospec; echo "<br />";


}
//UPDATE ANH DAI DIEN MAU SAN PHAM:
$sql_colorID = "SELECT * FROM procolor WHERE proID = $proID";
$resuilt_colorID = mysql_query($sql_colorID);
while($row_colorID = mysql_fetch_array($resuilt_colorID))
{
$colorID = $row_colorID['colorID']; 
$upload = new Upload_insert("img_color".$colorID.""); 

$upload->setUploadDir('image_product_detail/'); //thu muc ben ngoai admin
$upload->checkFileSize(1000);
$upload->checkFileType('gif|jpg|png'); 
if($upload->isVail() == false){
$upload->upload_update_procolor($colorID,$proID); 
}

}
?>
<script language="javascript">
alert("Đã cập nhật");
window.location.href='admin.php?go=product_edit&action=update&proID=<?php echo $proID?>';
</script>
<?php
}
else
{
echo("<script> alert('Cập nhật không thành công');</script>");
echo("<script>window.location='admin.php?go=product_list';</script>");	
}
}
?>

<form action="admin.php?go=product_edit&action=edit&proID=<?php echo($row_pro['proID']);?>" method="post" enctype="multipart/form-data" name="frmadd" id="frmadd" onsubmit="return CheckFormPro()">
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
		<td class="row" align="left"><img  height="75"  border="0" width="90"src="../image/<?php echo $row_pro['proImage'];?> " /></td>
		</tr>
		<tr>
		<td width="40%" align="right" class="row">Dòng sản phẩm: </td>
		<td align="left" class="row"><select name="modID" id="modID">
		<!--echo mã modID của  sản phẩm nhưng hiển thị dưới dạng tên -->
		<?php
		$sql = "select * from product,model where product.modID=model.modID and product.modID=".$row_pro['modID'];
		$result=mysql_query($sql,$connect);
		$row_modName=mysql_fetch_array($result);
		
		?>
		<option value="<?php echo $row_modName['modID'];?>"><?php echo $row_modName['modName'];?></option>
		<?php
		$sql="Select * from model";
		$resuilt=mysql_query($sql);
		?>
		<?php
		while($row=mysql_fetch_array($resuilt))
		{
		?>
		<option value="<?php echo $row['modID']; ?>"><?php echo $row['modName']; ?></option>
		<?php }?>
		</select>		</td>
		</tr>
		
		<tr>
		<td class="row" align="right">Mô tả: </td>
		<td class="row" align="left">
		<textarea name="proDescription" id="proDescription" cols="35" rows="3"><?php echo($row_pro['proDescription']);?></textarea></td>
		</tr>
		<tr>
		<td class="row" align="right">Giá:</td>
		<td class="row" align="left"><input name="proPrice" id="proPrice" value="<?php echo($row_pro['proPrice']);?>" type="text" size="45" />
		<br />
		(<?php echo(number_format($row_pro['proPrice']));?> VND)</td>
		</tr>
		<tr>
		<td class="row" align="right">Bảo Hành : </td>
		<td class="row" align="left">
		<input  value="<?php echo($row_pro['proWarranty']);?>"name="proWarranty" id="proWarranty" type="text" size="45" /></td>
		</tr>
		<tr>
		<td class="row" align="right">Số lượng: </td>
		<td class="row" align="left">
		<input name="proQuantity" id="proQuantity" type="text" size="45" value="<?php echo($row_pro['proQuantity']);?>"/></td>
		</tr>
		<tr>
		<td class="row" align="right">Trạng thái </td>
		<td class="row" align="left"><select name="proStatus" id="proStatus">
		<?php if($row_pro['proStatus']==1) {?>
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
<td height="50" align="center" style="font-size:18px">
<!---------PROCOLOR------>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td class="title">ẢNH CÁC MÀU SẢN PHẨM </td>
		</tr>
		<tr>
		<?php
		$sql_color = "SELECT    color.*, procolor.*
		FROM      Product INNER JOIN
		procolor ON Product.proID = procolor.proID INNER JOIN
		color ON procolor.colorID = color.colorID and product.proID=".$proID;
		$result_color = mysql_query($sql_color,$connect);
		while($row_color = mysql_fetch_array($result_color))
		{
		?>
		<td class="row">
				<table width="100%" border="0" align="center" >
				<tr>
				<td width="23%" align="right" class="row">Ảnh màu <?php echo $row_color['colorName'] ?><em><strong>:</strong></em><br />
				<img src="../media/<?php echo $row_color['Img_color']?>" border="1" /></td>
				<td width="64%">
				<?php if(!empty($row_color['Img'])) {?>
				<img src="image_product_detail/<?php echo $row_color['Img']?>" border="1" width="100" height="60" />
				<?php }else{?>
				<img src="image_product_detail/uploadImage.jpg" border="1" width="100" height="60" />
				<?php }?>
				<label></label></td>
				<td class="row" width="13%" align="center" valign="middle">
				<?php if(!empty($row_color['Img'])) {?>
				<a href="admin.php?go=product_edit&action=delete_img_color&proID=<?php  echo($row_pro['proID']);?>&colorID=<?php echo $row_color['colorID']?>" 
				onclick="if(confirm('Bạn chắc chắn xóa ảnh này?')) return true; else return false;"> 
				<img src="../media/close.gif" width="20" height="20" alt="Xóa ảnh" border="0" /> </a>
				<?php }?>
				 </td>
				</tr>
				<tr>
				<td width="23%" align="right" class="row">Link ảnh mới: </td>
				<td colspan="2" class="row">
				<input type='file' name='img_color<?php echo $row_color['colorID']?>' id="img<?php echo $row_color['colorID']?>" /></td>
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
		<!------END PROCOLOR----->

</td>
</tr>	
	
<tr>
<td height="50" align="center" style="font-size:18px">
<!---------------------------TÍNH NĂNG SẢN PHẨM------------------------------->
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td class="title">TÍNH NĂNG SẢN PHẨM</td>
		<td align="center" class="title">
		<a href="admin.php?go=upload_img_add&action=upload_img_add&proID=<?php echo($row_pro['proID']);?>">
		<span class="title">Thêm tính năng mới</span></a></td>
		</tr>
		<tr>
		<?php
		$sql_img="select * from image where proID=".$_REQUEST['proID']." order by imgID Desc";
		$result_img = mysql_query($sql_img,$connect);
		$i=0;
		while($row_img = mysql_fetch_array($result_img))
		{
		?>
		<td colspan="2" class="row">
				<table width="100%" border="0" cellspacing="3" cellpadding="3">
				<tr>
				<td width="23%" align="right" class="row">Ảnh tính năng:</td>
				<td width="61%" class="row"><img src="image_product_detail/<?php echo $row_img['imgUrl']?>" border="1" width="100" height="60" /></td>
				<td width="16%" align="center" valign="middle" class="row">
				<a href="admin.php?go=product_edit&action=delete_img&proID=<?php  echo($row_pro['proID']);?>&imgID=<?php echo $row_img['imgID']?>" 
				onclick="if(confirm('Bạn chắc chắn xóa ảnh này?')) return true; else return false;">
				<img src="../media/close.gif" width="20" height="20" alt="Xóa ảnh" border="0" />				</a>	</td>
				</tr>
				<tr>
				<td align="right" class="row">Link ảnh mới</td>
				<td class="row" colspan="2"><input type='file' name='img<?php echo $row_img['imgID'] ?>' id="img<?php echo $row_img['imgID']?>" /></td>
				</tr>
				<tr>
				<td align="right" class="row">Tên tính năng </td>
				<td class="row" colspan="2">
				<input name="title<?php echo $row_img['imgID']?>" type="text" class="text" size="50" value="<?php echo $row_img['imgTitle']?>" /></td>
				</tr>
				<tr>
				<td align="right" class="row">Mô tả </td>
				<td colspan="2" class="row">
				<textarea name="text<?php echo $row_img['imgID']?>" cols="40" rows="4" class="text" id="text<?php echo $row_img['imgID']?>" width="70">
				<?php echo $row_img['imgComment']?>
				</textarea>
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
<!---------------------END TÍNH NĂNG SẢN PHẨM---------------------->
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
		$sql = "SELECT    Specifications.*, ProSpec.*
		FROM      Product INNER JOIN
		ProSpec ON Product.proID = ProSpec.proID INNER JOIN
		Specifications ON ProSpec.specID = Specifications.specID and product.proID=".$proID;
		$qr = mysql_query($sql);
		$i=0;
		while($rown = mysql_fetch_array($qr))
		{
		$psContent = $row['psContent'];
		?>
		<td class="row">
				<table width="100%" border="0" cellspacing="1" cellpadding="1">
				<tr>
				<td class="row" width="40%" align="right"><?php echo($rown['specName']);?></td>
				<td class="row" align="left">
				<input  name="txtck<?php=$rown[specID]?>" type="text"  value="<?php echo($rown['psContent']);?>"size="45"/>
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

