<?
$action=$_REQUEST['action'];
$newid=$_REQUEST['nid'];
if($action=='detail')
$sql=mysql_query("select * from news where nID = ".$newid);
?>
<?
while($row=mysql_fetch_array($sql))
{
?>
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50"background="../media/banner_l.jpg" align="center"><span class="style1">CHI TIẾT TIN TỨC </span></td>
</tr>
<tr>
<td class="row" height="200" align="center" valign="top"><table width="70%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="center"><div id="title"><? echo($row['nName']);?></div></td>
</tr>
<tr>
<td colspan="2" align="left"><div class="datetime"> Ngày tháng:<? echo($row['newDate']);?></div></td>
</tr>
<tr>
<td colspan="2" align="left"><div class="status"> Trang thái:   <?
if($row['status']==1){
echo("Hiển thị");
}else{
echo("Ẩn");
}
?></div></td>
</tr>
<tr>
<td colspan="2" align="left"><div class="header"><? echo($row['nHeader']);?></div></td>
</tr>
<tr>
<td height="350" colspan="2" align="center"><img src="../newspicture/<? echo($row['nImage']);?>" width="500" height="300" /></td>
</tr>
<tr>
<td height="50" colspan="2" align="left"><? echo($row['nContent']);?></td>
</tr>
<tr>
<td width="50%" align="right"><label>
<input type="button" name="Button" value="Sửa"  onclick="location.href='admin.php?go=news_edit&action=update&nid=<? echo $row['nID'];?>'"/>
</label></td>
<td align="left"><label>
<input type="button" name="Button" value="Quay lại" onclick="location.href='admin.php?go=news_list'" />
</label></td>
</tr>
</table></td>
</tr>

</table>
<? }?>
