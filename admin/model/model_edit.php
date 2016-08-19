<?
$act=$_REQUEST['action'];
if($act=="update")
{
$sql_update="Select * from category where cateID=".$_REQUEST['mid'];
$result=mysql_query($sql_update,$connect);

$row_upd=mysql_fetch_array($result);
} 


if($act=="edit")
{
$catID=$_REQUEST["catID"];
$modName=$_REQUEST["modName"];
$modStatus=$_REQUEST["modStatus"];

$modID=$_REQUEST['mid'];
$sql_edit="Update category Set gpCateID='$catID', cateName='$modName',status=$modStatus where cateID=".$modID;
if(mysql_query($sql_edit,$connect))
{
echo("<script> alert('Đã cập nhật');</script>");		
echo("<script>window.location='admin.php?go=model_list';</script>");
}
}
?>
<script>
	function CheckFormMod11()
	{
		var obj1=document.getElementById('catID');
		var obj2=document.getElementById('modName');
		//var reg=/^[a-zA-Z]+[a-zA-Z0-9_ ]*$/;
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


<form action="?go=model_edit&action=edit&mid=<? echo $row_upd['cateID'];?>" method="post" name="frmedit" id="frmedit" onsubmit="return CheckFormMod11()">
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" background="../media/banner_l.jpg" align="center"><span class="style1">THÊM MỚI DÒNG SẢN PHẨM </span></td>
</tr>
<tr>
<td class="row" width="40%" align="right">Loại sản phẩm </td>
<td class="row" width="60%" align="left"><label>


<select name="catID" id="catID">
<!--echo mã catID của dòng sản phẩm nhưng hiển thị dưới dạng tên catName-->
<?
$sql = "select * from category,group_category where category.gpCateID=group_category.gpCateID and category.gpCateID=".$row_upd['gpCateID'];
$result=mysql_query($sql,$connect);
$row_catName=mysql_fetch_array($result);

?>
<option value="<? echo $row_catName['gpCateID'];?>" selected="selected"><? echo $row_catName['gpCateName'];?></option>

<!------------------------------------------------------>

<?
$sql="Select * from group_category where gpCateID!=".$row_upd['gpCateID'];
$resuilt=mysql_query($sql,$connect);

?>
<?
while($row=mysql_fetch_array($resuilt))
{
?>
<option value="<? echo $row['gpCateID']; ?>"><? echo $row['gpCateName']; ?></option>
<? }?>

</select>
<tr>
<td class="row" align="right">Tên dòng sản phẩm </td>
<td class="row" align="left"><label>
<input name="modName"  id="modName"  value="<? echo $row_upd['cateName'];?>"type="text" size="35">
</label></td>
</tr>
<tr>
<td class="row" align="right">Trạng thái </td>
<td class="row" align="left"><label>
<select name="modStatus" id="modStatus">
<? if($row_upd['status']==1) {?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<? } else {?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<? }?>
</select>
</label></td>
</tr>
<tr>
<td class="row" align="right"><label>
<input type="submit" name="Submit" value="Cập nhật">
</label></td>
<td class="row" align="left"><label>
<input type="button" name="Submit2" value="Quay lại" onClick="location.href='admin.php?go=model_list'">
</label></td>
</tr>

</table>
</form>