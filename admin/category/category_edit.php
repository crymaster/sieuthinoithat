<?php
$action=$_REQUEST['action'];
$catid=$_REQUEST['cid'];
if($action=='update')
$sql=mysql_query("select * from group_category where gpCateID = ".$catid."",$connect);

if($action=='edit')
{
$catname=$_REQUEST['catName'];
$catstatus=$_REQUEST['cstatus'];
$sql="update group_category set gpCateName ='" . $catname . "',status ='" . $catstatus . "' where gpCateID =".$catid;
if(mysql_query($sql,$connect))
{
	echo("<script> alert('Đã cập nhật');</script>");
	echo("<script>window.location='admin.php?go=category_list';</script>");	
}

}
?>
<?php
if($action=='update')
{
while($row=mysql_fetch_array($sql))
{
?>
<script>
	function CheckFormCate1()
	{
		var obj=document.getElementById('catName');
		var str=obj.value;
		var reg=/^([a-zA-Z]* )*$/;
		if(!reg.test(str))
		{
			return true;
			
		}
		else
		{
			alert('Bạn phải nhập dữ liệu !');
			obj.focus();
			return false;
		}
		
	}
</script>
<form action="admin.php?go=category_edit&action=edit&cid=<?php echo($catid);?>" method="post" name="frmcategory" id="frmcategory"  onsubmit="return CheckFormCate1()">
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">CHỈNH SỬA LOẠI SẢN PHẨM</span></td>
</tr>
<tr>
<td class="row" width="42%" align="right" >Tên loại sản phẩm</td>
<td class="row" width="58%" align="left"><input name="catName" id="catName" type="text" value="<?php echo($row['gpCateName']);?>" size="35">
</td>
</tr>
<tr>
<td class="row" align="right" >Trạng thái</td>
<td class="row" align="left" ><select name="cstatus">
<?php
if($row['status']==1){
?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php
}else{
?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td class="row" align="right" ><input type="submit" name="Submit" value="Cập nhật"></td>
<td class="row" align="left" ><input type="button" name="Button" value="Quay lại" onClick="location.href='admin.php?go=category_list'">
</td>
</tr>
</table>
</form>
<?php
}
}  
?>
