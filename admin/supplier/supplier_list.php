<?php
$record_per_page = 10;
$pagenum = $_GET["page"];
$page = "admin.php?go=supplier_list";
?>
<?php
$sql = "select * from supplier order by subID Desc";
$resuilt = mysql_query($sql,$connect);

//begin loop:	
$totalpage =ceil( mysql_num_rows($resuilt) / $record_per_page);

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
$resuilt=mysql_query($sql,$connect);

?>

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="8" background="../media/banner_l.jpg" align="center"><span class="style1">DANH SÁCH NHÀ CUNG CẤP </span></td>
</tr>
<tr>
<td width="17%" align="center" class="row_one">Mã  nhà cung cấp</td>
<td class="row_one" width="17%" align="center">Tên nhà cung cấp </td>
<td class="row_one" width="16%" align="center">Số điện thoại </td>
<td class="row_one" width="12%" align="center">Địa chỉ </td>
<td class="row_one" width="13%" align="center">Email</td>
<td class="row_one" width="12%" align="center">Trạng thái </td>
<td class="row_one" colspan="2" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php while($row=mysql_fetch_array($resuilt))
{
?>
<tr>
<td class="row" align="center"><label></label>
<?php echo $row['subID'];?></td>
<td class="row" align="center"><?php echo $row['subName'];?></td>
<td class="row" align="center"><?php echo $row['phone'];?></td>
<td class="row" align="center"><?php echo $row['subAdd'];?></td>
<td class="row" align="left"><?php echo $row['email'];?></td>
<td class="row" align="center"><select name="select" onchange="location.href='admin.php?go=supplier_list&action=change&sid=<?php echo $row['subID'];?>&status='+this.value;">
<?php if($row['status']==1)  {?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php } else {?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?php }?>
</select>
</td>
<td class="row" width="6%" align="center"><a href="admin.php?go=supplier_edit&action=update&sid=<?php echo $row['subID'];?>">Sửa</a></td>
<td class="row" width="7%" align="center"><?php
$sql_xoa="Select * from product  where subID=".$row['subID'];
$result=mysql_query($sql_xoa,$connect);
if(mysql_num_rows($result))
{
echo '|||';
}
else
{
?>
<a href="admin.php?go=supplier_list&action=del&sid=<?php echo $row['subID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php
}
?></td>
</tr>
<?php } ?>
</table>
<?php
/*
Vong lap de tao ra cac link lien ket den cac trang du lieu.
Output: 	1 | 2 | 3 | 4 
*/
for($i =1; $i<=$totalpage;$i++)
{
if ($i==1){
echo "<a href='".$page."&page=".$i."' >".$i."</a>"	;	
}else{
if($pagenum==$i)			
echo " | <a href='".$page."&page=".$i."'><B><font color=red><u>".$i."</u></font></B></a>";
else
echo " | <a href='".$page."&page=".$i."'>".$i."</a>";
}
}
echo("<font color=red>  &nbsp; &nbsp;(Page: &nbsp; ".$pagenum."&nbsp;/&nbsp;".$totalpage.")");
?>
<?php
$action = $_REQUEST['action'];
if($action == 'del')
{
$sql_xoa = "Delete From supplier Where subID=".$_REQUEST['sid'];
if(mysql_query($sql_xoa,$connect))
{
echo ('<script>alert("Đã xóa xong!");</script>');
echo("<script>window.location='admin.php?go=supplier_list';</script>");
}
}



if($action=="change")
{
$sql_update="Update Supplier set supStatus=".$_REQUEST['status']." where supID=".$_REQUEST['sid'];
if(mysql_query($sql_update,$connect))
{
echo("<script>window.location='admin.php?go=supplier_list';</script>");	
}
}	
?>
