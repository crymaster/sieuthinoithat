
<?
$action=$_REQUEST['action'];
$newid=$_REQUEST['nid'];
if($action=='update')
$sql=mysql_query("select * from news where nID = ".$newid,$connect);
if($action=='edit')
{
require_once('upload_img.php');
$newtitle=$_REQUEST['ntitle'];
$newheader = $_REQUEST['newheader'];
$newcontent=$_REQUEST['ncontent'];
$newstatus=$_REQUEST['nstatus'];
$anh = $_REQUEST['txtanh'];
if($anh==""){
$sql="update news set nName ='$newtitle',nHeader='$newheader',nContent ='$newcontent',newDate =NOW(),status ='$newstatus' where nID =".$newid;
}else{
$sql="update news set nName ='$newtitle',nHeader='$newheader',nImage ='$anh',nContent ='$newcontent',newDate =NOW(),status ='$newstatus' where nID =".$newid;
}
$re=mysql_query($sql,$connect);
echo("<script> alert('Đã cập nhật');</script>");
echo("<script>window.location='admin.php?go=news_list';</script>");	
}
?>
<?
if($action=='update')
{
while($row=mysql_fetch_array($sql))
{
?>
<form action="admin.php?go=news_edit&action=edit&nid=<? echo($newid);?>" method="post" enctype="multipart/form-data" name="frmnewedit" id="frmnewedit" onsubmit="return CheckFormNews()" >
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="3" align="center" background="../media/banner_l.jpg"><span class="style1">SỬA CÁC TIN TỨC </span></td>
</tr>
<tr>
<td class="row" width="34%" align="right">Tiêu đề:</td>
<td colspan="2" align="left" class="row"><input name="ntitle" type="text" id="ntitle" size="50" value="<? echo($row['nName']);?>"  /></td>
</tr>
<tr>
<td class="row" align="right">Mở đầu </td>
<td class="row" width="26%" align="left"><label>
<textarea name="newheader" cols="80" rows="5"><? echo($row['nHeader']);?></textarea>
</label></td>
<td class="row" width="40%" align="center" valign="bottom">Ảnh hiện thị cũ</td>
</tr>
<tr>
<td class="row" align="right" valign="middle">Nội dung:</td>
<td>
<textarea name="ncontent" cols="80" rows="20" id="ncontent"><? echo($row['nContent']);?></textarea>      </td>
<td class="row" rowspan="4" align="center" valign="top"><img src="../newspicture/<? echo($row['nImage']);?>" width="250" height="250" /></td>
</tr>
<tr>
<td class="row" align="right" valign="middle">Ảnh thay thế:</td>
<td class="row" align="left">
<input name="txtanh" type="text" value="<?=$anh?>" size="20" />
<input name="upload" type="button" id="upload" value="Upload" onclick="window.open('upload.php?Thumuc=../newspicture&form=frmnewedit&input=txtanh&anh=AnhSP','','width=400,height=200');"/>
<p><img name="AnhSP" id="AnhSP" src="../newspicture/<?=$anh?>" width="200" height="200" alt="" /></p>    </td>
</tr>
<tr>
<td class="row" align="right">Trạng thái:</td>
<td class="row" align="left">
<select name="nstatus" id="nstatus">
<?
if($row['status']==1){
?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?
}else{
?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?
}
?>
</select></td>
</tr>
<tr>
<td class="row">&nbsp;</td>
<td class="row" colspan="2" align="left"><input type="submit" name="Submit" value="Cập nhật" />
<input name="Button" type="button" id="Reset" value="Quay lại"  onClick="location.href='admin.php?go=news_list'"/></td>
</tr>
</table>
</form>
<?
}
}  
?> 