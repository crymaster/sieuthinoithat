<?php

$act=$_REQUEST['action'];
if($act=="update")
{
	$sql_update="Select * from attribute where attID=".$_REQUEST['specID'];
	$result=mysql_query($sql_update,$connect);
	$row_upd=mysql_fetch_array($result);
}
	
	
if($act=="edit")
{
	$specName=$_REQUEST["specName"];
	$specID=$_REQUEST['specID'];
	$status=$_REQUEST['specStatus'];
	$sql_upd="Update attribute Set attName='$specName' , status = $status where attID=".$specID;
	
	if(mysql_query($sql_upd,$connect))
	{
		echo("<script> alert('Đã cập nhật');</script>");
		echo("<script>window.location='admin.php?go=spec_list';</script>");
	}
}
?>

<form action="?go=spec_edit&action=edit&specID=<?php echo $row_upd['attID'];?>" method="post" name="frmadd" id="frmcategoryadd" onsubmit="return CheckFormSpec()">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="3" align="center" background="../media/banner_l.jpg"><span class="style1">SỬA THÔNG SỐ KỸ THUẬT </span></td>
</tr>
<tr>
<td class="row" colspan="2" align="right">Mã Thông số</td>
<td class="row" width="60%" align="left"><?php echo $row_upd['attID'] ;?></td>
</tr>
<tr>
<td class="row" colspan="2" align="right">Tên thông số </td>
<td class="row" align="left"><input name="specName"  value="<?php echo $row_upd['attName'] ;?> "type="text" size="50" /></td>
</tr>
<tr>
<td class="row" colspan="2" align="right">Trạng thái </td>
<td class="row" align="left">
	<select name="specStatus" id="specStatus"> 
		<?php if($row_upd['status']==1) { ?>
			<option value="<?php echo $row_upd['status']; ?>" selected="selected">Hiện </option>
			<option value="<?php echo 1- $row_upd['status']; ?>">Ẩn </option>
			<?php } else{ ?>
			<option value="<?php echo $row_upd['status']; ?>" selected="selected">Ẩn </option>
			<option value="<?php echo 1- $row_upd['status']; ?>">Hiện </option>
			<?php } ?>
	</select>
</td>
</tr>
<tr>
<td class="row" colspan="2" align="right"><input type="submit" name="Submit" value="cập nhật" /></td>
<td class="row" align="left"><input type="button" name="Submit2" value="Quay lại" onClick="location.href='admin.php?go=spec_list'" /></td>
</tr>
</table>
</form>
