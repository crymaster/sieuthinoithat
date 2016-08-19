
<?php 

$action=$_REQUEST['action'];
if($action=="add")
{
	$supName=$_REQUEST['supName'];
	$supPhone=$_REQUEST['supPhone'];
	$supAdd=$_REQUEST['supAdd'];
	$supEmail=$_REQUEST['supEmail'];
	$supStatus=$_REQUEST['supStatus'];
	
	$sql="select * from supplier where subName='".$supName."'";
	$re=mysql_query($sql,$connect);
	$num=mysql_num_rows($re);
if($num>=1)
{
	echo("<script>alert('Tên  nhà cung cấp đã có trong CSDL ');</script>");
}
else
{
	$sqlsupAdd="Insert Supplier(subName,subAdd,email,status,phone) 
	values('$supName','$supAdd','$supEmail','$supStatus','$supPhone')";

if(mysql_query($sqlsupAdd,$connect))
{
	echo("<script> alert('Đã thêm mới');</script>");
	echo("<script>window.location='admin.php?go=supplier_list';</script>");	
}
}

}


?>
<form action="?go=supplier_add&action=add" method="post" name="frmsupadd" id="frmsupadd" onsubmit="return CheckFormSup()">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" align="center"background="../media/banner_l.jpg"><span class="style1">THÊM MỚI NHÀ CUNG CẤP</span></td>
</tr>


<tr>
<td class="row" width="40%" align="right">Tên nhà cung cấp </td>
<td class="row" width="60%" align="left"><label>
<input name="supName" type="text" id="supName" size="35" />
</label></td>
</tr>
<tr>
<td class="row" width="40%" align="right">Số điện thoại </td>
<td class="row" align="left"><label>
<input name="supPhone" id="supPhone" type="text" size="35" />
</label></td>
</tr>
<tr>
<td class="row" align="right">Địa chỉ </td>
<td class="row" align="left"><label>
<textarea name="supAdd"  id="supAdd"cols="32"></textarea>
</label></td>
</tr>
<tr>
<td class="row" align="right">Email</td>
<td class="row" align="left"><label>
<input name="supEmail" id="supEmail" type="text" size="35" />
</label></td>
</tr>
<tr>
<td class="row" align="right">Trạng thái </td>
<td class="row" align="left"><label>
<select name="supStatus" id="supStatus">
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
</select>
</label></td>
</tr>

<tr>
<td class="row" align="right"><label>
<input type="submit" name="Submit" value="Thêm mới" />
</label></td>
<td class="row" align="left"><label>
<input type="reset" name="Submit2" value="Nhập lại" />
</label></td>
</tr>
</table>
</form>
