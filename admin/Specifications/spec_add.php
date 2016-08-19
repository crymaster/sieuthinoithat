<?php
$action=$_REQUEST['action'];
if($action=='add')
{
	$specName=$_REQUEST['specName']; 
	$status=$_REQUEST['status']; 
//tạo câu lệnh
	if($specName=="")
	{
		echo "<script> alert('Bạn chưa nhập tên thông số'); </script>";
		echo "<script> window.location='admin.php?go=spec_add' </script>";
	}
	else
	{
		$sql_check="Select * from attribute where attName='".$specName."'";
		$result1=mysql_query($sql_check,$connect);
		$num1=mysql_num_rows($result1);
		if($num1>=1)
		{
			echo "<script> alert('Thông số đã tồn tại'); </script>";
			echo "<script> window.location='admin.php?go=spec_add';  </script>";
		}
		else
		{
			$sql_addspec = "Insert attribute(attName,status) values('$specName',$status)";
			$result2=mysql_query($sql_addspec,$connect);
			if($result2)
			{
				echo "<script>  alert('Thêm thông số thành công'); </script>";
				echo "<script>  window.location='admin.php?go=spec_list'; </script>";
			}
		}
	}
}
?>

<form action="?go=spec_add&action=add" method="post" name="frmadd" id="frmadd" onsubmit="return CheckFormSpec()">
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
	<tr>
	<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THÊM THÔNG SỐ KỸ THUẬT </span></td>
	</tr>
	<tr>
	<td class="row" align="right">Tên thông số </td>
	<td class="row" width="60%" align="left"><input name="specName" id="specName" type="text" size="50"   /></td>
	</tr>
	<tr>
	<td class="row" align="right">Trạng thái </td>
	<td class="row" width="60%" align="left">
		<select name="status" id="status">
			<option value="1">Hiện </option>
			<option value="0"> Ẩn</option>
		</select>
	
	</td>
	</tr>
	<tr>
	<td class="row" align="right"><input type="submit" name="Submit" value="cập nhật" /></td>
	<td class="row" align="left"><input type="reset" name="Submit2" value="Nhập lại" /></td>
	</tr>
	</table>
</form>

