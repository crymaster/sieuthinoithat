<?php
$record_per_page = 15;
$pagenum = $_GET["page"];
$sid = $_REQUEST['sid'];
$page = "admin.php?go=model_list&sid=".$sid;
?>
<?php
if($sid==0)
{
	//$sql = "select * from category  order by cateID Desc";
	$sql = "SELECT category. *
FROM category
INNER JOIN group_category ON category.gpCateID = group_category.gpCateID
WHERE group_category.status =1";
	
}
else{
$sql = "select * from category where gpCateID=".$sid;
}

$resuilt = mysql_query($sql,$connect);	
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
//echo($sql);
//die();
$resuilt=mysql_query($sql,$connect);
?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" >
<tr>
<td height="50" colspan="7" background="../media/banner_l.jpg" align="center"><span class="style1">DANH SÁCH DÒNG SẢN PHẨM </span></td>
</tr>
<tr>
<td class="row" colspan="7" align="center">Xem dòng sản phẩm theo loại sản phẩm
<select name="select2" onChange="location.href='admin.php?go=model_list&sid='+this.value+'&page=<?php echo($pagenum)?>'">
<?php
$sql_sup="Select * from group_category where status=1";
$resuilt_sup=mysql_query($sql_sup,$connect);

?>
<option value="0" >-Xem tất cả-</option>
<?php
while($row_sup=mysql_fetch_array($resuilt_sup))
{
if($row_sup['gpCateID']==$sid)
{
?>
<option value="<?php echo $row_sup['gpCateID'];?>" selected="selected"><?php echo $row_sup['gpCateName'];?></option>
<?php } else{?>
<option value="<?php echo $row_sup['gpCateID'];?>"><?php echo $row_sup['gpCateName'];?></option>
<?php }  }?>
</select>    </td>
</tr>
<tr>
<td class="row_one" align="center">Mã dòng sản phẩm</td>
<td class="row_one" align="center">Tên dòng sản phẩm </td>
<td class="row_one" align="center">Loại sản phẩm </td>
<td class="row_one" align="center">Trạng thái</td>
<td class="row_one" colspan="2" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php while($row=mysql_fetch_array($resuilt))  {    ?>
<tr>
<td class="row" align="center"><label></label>      <?php echo $row['cateID'];?></td>
<td class="row" align="center"><?php echo $row['cateName'];?></td>
<?php
$sql = "select * from category,group_category where category.gpCateID=group_category.gpCateID and category.gpCateID=".$row['gpCateID'];
$result=mysql_query($sql,$connect);
$row_catName=mysql_fetch_array($result);
?>
<td class="row" align="center"><?php echo $row_catName['gpCateName'];?></td>
<td class="row" align="center"><label>
<select name="select" onchange="location.href='admin.php?go=model_list&action=change&mid=<?php echo $row['cateID'];?>&status='+this.value;">
<?php if($row['status']==1) {?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php }else{?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?php }?>
</select>
</label></td>
<td class="row" align="center"><a href="admin.php?go=model_edit&action=update&mid=<?php echo $row['cateID'];?>">Sửa</a></td>
<td class="row" align="center"><?php
$sql_xoa="Select * from product_category where cateID=".$row['cateID'];
$result=mysql_query($sql_xoa,$connect);
if(mysql_num_rows($result))
{
echo '|||';
}
else
{ 
?>
<a href="admin.php?go=model_list&action=del&mid=<?php echo $row['cateID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php
}
?>    </td>
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
$sql_xoa = "Delete From category Where cateID=".$_REQUEST['mid'];
if(mysql_query($sql_xoa,$connect))
{
echo ('<script>alert("Đã xóa xong!");</script>');
echo("<script>window.location='admin.php?go=model_list';</script>");
}
}



if($action=="change")
{
$sql_update="Update category set status=".$_REQUEST['status']." where cateID=".$_REQUEST['mid'];
if(mysql_query($sql_update,$connect))
{
echo("<script>window.location='admin.php?go=model_list';</script>");	
}
}	
?>
