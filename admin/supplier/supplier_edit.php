<?php
	 
	$act=$_REQUEST['action'];
	if($act=="update")
	{
		$sql_update="Select * from supplier where subID=".$_REQUEST['sid'];
		$result=mysql_query($sql_update);
		
		$row_upd=mysql_fetch_array($result);
	}
	
	 
	if($act=="edit")
	{
					$supName=$_REQUEST["supName"];
					$supPhone=$_REQUEST['supPhone'];
					$supAdd=$_REQUEST["supAdd"];
					$supEmail=$_REQUEST['supEmail'];
					$supStatus=$_REQUEST["supStatus"];
					$supID=$_REQUEST['sid'];
					$sql_edit="Update supplier Set subName='$supName', phone='$supPhone', subAdd='$supAdd', email='$supEmail', status=$supStatus where subID=".$supID;
					if(mysql_query($sql_edit,$connect))
					{
						echo("<script> alert('Đã cập nhật');</script>");					
						echo("<script>window.location='admin.php?go=supplier_list';</script>");
					}
	}
?>
<form action="admin.php?go=supplier_edit&action=edit&sid=<?php echo $row_upd['subID'];?>" method="post" name="frmsupedit" id="frmsupedit" onsubmit="return CheckFormSup();">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td height="50" colspan="2" align="center"background="../media/banner_l.jpg"><span class="style1">CHỈNH SỬA THÔNG TIN NHÀ CUNG CẤP</span></td>
  </tr>
  
  
  <tr>
    <td class="row" width="40%" align="right">Mã nhà cung cấp </td>
    <td class="row" width="60%" align="left"><?php echo $row_upd['subID'];?></td>
  </tr>
  <tr>
    <td class="row" align="right">Tên nhà cung cấp </td>
    <td class="row" width="60%" align="left"><input name="supName" type="text" id="supName" value="<?php echo $row_upd['subName'];?>" size="35"  /></td>
  </tr>
  <tr>
    <td class="row" width="40%" align="right">Số điện thoại </td>
    <td class="row" align="left"><label>
      <input name="supPhone" id="supPhone" type="text"  value="<?php echo $row_upd['phone'];?>"size="35" />
    </label></td>
  </tr>
  <tr>
    <td class="row" align="right">Địa chỉ </td>
    <td class="row" align="left"><label>
      <textarea name="supAdd"  id="supAdd" class="txtarea"  cols="32"> <?php echo $row_upd['subAdd'];?></textarea>
    </label></td>
  </tr>
  <tr>
    <td class="row" align="right">Email</td>
    <td class="row" align="left"><label>
      <input name="supEmail" id="supEmail" type="text" value="<?php echo $row_upd['email'];?>" size="35" />
    </label></td>
  </tr>
  <tr>
    <td class="row" align="right">Trạng thái </td>
    <td class="row" align="left"><label>
      <select name="supStatus" id="supStatus">
	  <?php if($row_upd['status']==1) {?>
        <option value="1">Hiện</option>
        <option value="0">Ẩn</option>
		<?php } else {?>
		<option value="0">Ẩn</option>
		<option value="1">Hiện</option>
		<?php }?>
      </select>
    </label></td>
  </tr>
  
  <tr>
    <td class="row" align="right"><label>
      <input type="submit" name="Submit" value="Cập nhật" />
    </label></td>
    <td class="row" align="left"><label>
      <input type="reset" name="Submit2" value="Quay lại" onClick="location.href='admin.php?go=supplier_list'" />
    </label></td>
  </tr>
</table>
</form>
<style type="text/css">
.txtarea
{
font-family:"Times New Roman", Times, serif;
font-size:14px;
}
</style>
