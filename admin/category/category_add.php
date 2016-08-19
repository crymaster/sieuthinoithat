<?php
$action=$_REQUEST['action'];
if($action=='add')
{
$catname=$_REQUEST['catName'];
if($catname=="")
{
	echo "<script> alert('Bạn chưa nhập tên loại sản phẩm'); </script>";
	echo "<script>window.location='admin.php?go=category_add' </script>";
}
else
{
$catstatus=$_REQUEST['catStatus'];
$sql="select * from group_category where gpCateName='".$catname."'";
$re=mysql_query($sql,$connect);
$num=mysql_num_rows($re);
if($num>=1)
{
echo("<script>alert('Tên  loại sản phẩm đã có trong CSDL ');</script>");
}
else
{
$sql_add="insert into group_category(gpCateName , status ) values ('".$catname."' , ".$catstatus.")";

if(mysql_query($sql_add,$connect))
{
echo("<script> alert('Đã thêm mới');</script>");
echo("<script>window.location='admin.php?go=category_list';</script>");	
}
}
}
}
?>

<form action="?go=category_add&action=add" method="post" name="frmcategoryadd" id="frmcategoryadd" onsubmit=" return CheckFormCate()" >
<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td  height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THÊM MỚI LOẠI SẢN PHẨM</span></td>
</tr>
<tr>
<td class="row" width="40%" align="right">Tên loại sản phẩm </td>
<td class="row" width="60%" align="left"><label>
<input name="catName" type="text" id="catName" size="35"  />
</label></td>
</tr>
<tr>
<td class="row" align="right">Trạng thái </td>
<td class="row" align="left"><label>
<select name="catStatus" id="catStatus">
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
</select>
</label></td>
</tr>
<tr>
<td class="row" align="right"><label></label>
<label>
<input type="submit" name="Submit" value="Thêm mới" />
</label>
</label></td>
<td class="row" align="left"><label>
<input type="reset" name="Submit2" value="Nhập lại" />
</label></td>
</tr>
</table>
</form>
