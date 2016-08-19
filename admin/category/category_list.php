<?php
$record_per_page =10;
$pagenum = $_GET["page"];
?>
<?php
$page = "admin.php?go=category_list";
$_SESSION['url']="admin.php?go=category_list";

$sql="select * from group_category  order by gpCateID Desc";
$re=mysql_query($sql,$connect);	
$totalpage =ceil( mysql_num_rows($re) / $record_per_page);
if(!$pagenum || $pagenum <=0 || $pagenum > $totalpage)
{
$pagenum = 1;
} 
if($pagenum == 1)
{
$from = 0;
}else{
$from = ($pagenum-1)*$record_per_page;
}
$sql =$sql." LIMIT ".$from.",".$record_per_page;
//echo($sql);
//	die();
$re=mysql_query($sql,$connect);
?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="5" align="center" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH LOẠI SẢN PHẨM</span></td>
</tr>
<tr>
<td class="row_one"><div align="center">Mã loại sản phẩm </div></td>
<td class="row_one"><div align="center">Tên loại sản phẩm </div></td>
<td class="row_one"><div align="center">Trạng thái </div></td>
<td class="row_one" colspan="2" align="center"><div align="center"><img src="media/s_fulltext.png" width="50" height="19" /></div></td>
</tr>
<?php
while($row_category=mysql_fetch_array($re))
{
?>
<tr>
<td class="row" align="center"><label></label>
<?php echo $row_category['gpCateID'];?></td>
<td class="row"><?php echo $row_category['gpCateName'];?></td>
<td class="row" align="center"><label>
<select name="select"   onchange="location.href='admin.php?go=category_list&action=change&cid=<?php echo $row_category['gpCateID'];?>&status='+this.value;">
<?php if($row_category['status']==1) { ?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php } else{?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?php }?>
</select>
</label></td>
<td class="row" align="center"><a href="admin.php?go=category_edit&action=update&cid=<?php echo $row_category['gpCateID'];?>">Sửa</a></td>
<td class="row" align="center"><?php
$sql_check="select * from category where gpCateID=".$row_category['gpCateID'];
$rel=mysql_query($sql_check,$connect);
if(mysql_num_rows($rel)>0)
{
echo("||||");
}
else{
?>
<a href="admin.php?go=category_list&action=del&cid=<?php echo $row_category['gpCateID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php
}
?>
</td>
</tr>
<?php }?>
</table>
<div align="center">
<?php
for($i =1; $i<=$totalpage;$i++)
{
if ($i==1){
echo "<a href='".$page."&page=".$i."' >".$i."</a>"	;	
}else{
echo " | <a href='".$page."&page=".$i."'>".$i."</a>";
}
}
echo("<font color=red>  &nbsp; &nbsp;(Page: &nbsp; ".$pagenum."&nbsp;/&nbsp;".$totalpage.")");
?>
</div>
</form>
<div align="center">
<?php
$action=$_REQUEST['action'];
$catid=$_REQUEST['cid'];
$catstatus=$_REQUEST['status'];
if($action=='change')
{
$sql_update="update group_category set status =".$catstatus." where gpCateID =".$catid;
if(mysql_query($sql_update,$connect))
{
echo("<script>window.location='admin.php?go=category_list';</script>");	
}
}
if($action=='del')
{
$sql_delete="delete from group_category where gpCateID = ".$catid;
if(mysql_query($sql_delete,$connect))
{
echo("<script> alert('Đã xóa xong');</script>");
echo("<script>window.location='admin.php?go=category_list';</script>");	
}
}
?>
</div>
