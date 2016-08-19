<? 

$action=$_REQUEST['action'];
if($action=="add")
{
$catID=$_REQUEST['catID'];
$modName=$_REQUEST['modName'];
$modStatus=$_REQUEST['modStatus'];
/*if($catID=="0")
{
	echo "<script> alert('Bạn chưa chọn loại sản phẩm'); </script>";
	echo "<script> window.location=admin.php?go=model_add </script>";
}
elseif($modName=="")
{
	echo "<script> alert('Bạn chưa nhập tên dòng sản phẩm'); </script>";
	echo "<script> window.location=admin.php?go=model_add </script>";
}
else
{*/
	$sql="select * from category where cateName='".$modName."'";
	$re=mysql_query($sql,$connect);
	$num=mysql_num_rows($re);
	if($num>=1)
	{
		echo("<script>alert('Tên dòng sản phẩm đã có trong CSDL ');</script>");
	}
	else
	{
		$sqlAdd="Insert category(cateName,status,gpCateID) 
		values('$modName','$modStatus','$catID')";
		
		if(mysql_query($sqlAdd,$connect))
		{
			echo("<script> alert('Đã thêm mới');</script>");
			echo("<script>window.location='admin.php?go=model_list';</script>");	
		}
	}
}



?>
<script>
	function CheckFormMod11()
	{
		var obj1=document.getElementById('catID');
		var obj2=document.getElementById('modName');
		var reg=/^[a-zA-Z]+[a-zA-Z0-9_ ]*$/;
		if(obj1.value==0)
		{
			alert('Bạn chưa chọn loại sản phẩm !');
			obj1.focus();
			return false;
		}
		if(obj2.value=="")
		{
			alert('Bạn chưa nhập tên dòng sản phẩm chưa đúng !');
			obj2.focus();
			return false;
		}
		return true;
	}
</script>

<form action="?go=model_add&action=add" method="post" name="frmadd" id="frmadd" onsubmit="return  CheckFormMod11();">

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" background="../media/banner_l.jpg" align="center"><span class="style1">THÊM MỚI DÒNG SẢN PHẨM </span></td>
</tr>
<tr>
<td class="row" width="40%" align="right">Loại sản phẩm </td>
<td class="row" width="60%" align="left"><label>

<?
$sql="Select * from group_category";
$resuilt=mysql_query($sql,$connect);

?>
<select name="catID" id="catID">
<option value="0" >--Chọn loại sản phẩm--</option>
<?
while($row=mysql_fetch_array($resuilt))
{
?>
<option value="<? echo $row['gpCateID']; ?>"><? echo $row['gpCateName']; ?></option>
<? }?>

</select>
</label></td>
</tr>

<tr>
<td class="row" align="right">Tên dòng sản phẩm </td>
<td class="row" align="left"><label>
<input name="modName"  id="modName" type="text" size="35">
</label></td>
</tr>
<tr>
<td class="row" align="right">Trạng thái </td>
<td class="row" align="left"><label>
<select name="modStatus" id="modStatus">
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
</select>
</label></td>
</tr>
<tr>
<td class="row" align="right"><label>
<input type="submit" name="Submit" value="Thêm mới">
</label></td>
<td class="row" align="left"><label>
<input type="reset" name="Submit2" value="Nhập lại">
</label></td>
</tr>

</table>
</form>