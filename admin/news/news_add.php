
<?
$action=$_REQUEST['action'];
if($action=='add')
{
require_once('upload_img.php');
$newtitle=$_REQUEST['ntitle'];
$nheader = $_REQUEST['nheader'];
$newcontent=$_REQUEST['ncontent'];
$newstatus=$_REQUEST['nstatus'];
$anh = $_REQUEST['txtanh'];
	if($newtitle=="")
	{
		echo "<script> alert('Bạn chưa nhập tiêu đề'); </script>";
		echo "<script> window.location='admin.php?go=news_add' </script>";
	}
$sql="insert into news(nName,nHeader,nImage,nContent,newDate,status) 
values ('".$newtitle."','".$nheader."','".$anh."','".$newcontent."',NOW(),'".$newstatus."')";
if(mysql_query($sql,$connect))
echo("<script> alert('Đã thêm mới');</script>");
echo("<script>window.location='admin.php?go=news_list';</script>");
}
?>


<form action="admin.php?go=news_add&action=add" method="post" enctype="multipart/form-data" name="frmnewadd" id="frmnewadd" onsubmit="return CheckFormNews()">
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THÊM TIN TỨC</span></td>
</tr>
<tr>
<td class="row" width="25%" align="right">Tiêu đề </td>
<td class="row" align="left"><label>
<input name="ntitle" id="ntitle" type="text" size="50" />
</label></td>
</tr>
<tr>
<td class="row" align="right">Mở đầu </td>
<td class="row" align="left"><label>
<textarea name="nheader" id="nheader" cols="80" rows="5"></textarea>
</label></td>
</tr>
<tr>
<td class="row" align="right">Nội dung </td>
<td class="row" align="left"><label>
<textarea name="ncontent" id="ncontent" cols="80" rows="20"></textarea>
</label></td>
</tr>
<tr>
<td class="row" align="right">Ảnh hiển thị </td>
<td class="row" align="left">

<input name="txtanh" type="text" value="<?=$anh?>" size="40" />
<input name="upload" type="button" id="upload" value="Upload" onclick="window.open('upload.php?Thumuc=../newspicture&form=frmnewadd&input=txtanh&anh=AnhSP','','width=400,height=200');"/>
<p><img name="AnhSP" id="AnhSP" src="../newspicture/<?=$anh?>" width="200" height="200" alt="" /></p>	</td>
</tr>
<tr>
<td class="row" align="right">Trạng thái </td>
<td class="row" align="left"><label>
<select name="nstatus">
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
</select>
</label></td>
</tr>
<tr>
<td class="row" align="right"><input type="submit" name="Submit" value="Thêm mới" /></td>
<td class="row" align="left"><input type="reset" name="Submit2" value="Nhập lại" /></td>
</tr>
</table>
</form>