<?php
$record_per_page = 10;
$pagenum = $_GET["page"];
$page = "admin.php?go=news_list";
?>
<?php
$sql="Select * from news order by newDate Desc";
$resuilt=mysql_query($sql,$connect);


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
$resuilt=mysql_query($sql);

?>

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="7"align="center" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH CÁC TIN TỨC </span></td>
</tr>
<tr>
<td class="row_one" width="9%" align="center">Mã Tin </td>
<td class="row_one" width="25%" align="center">Tiêu đề </td>
<td class="row_one" width="25%" align="center">Ảnh</td>
<td class="row_one" width="18%" align="center">Ngày tháng </td>
<td class="row_one" width="11%" align="center">Trạng thái </td>
<td class="row_one" colspan="2" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
while($row=mysql_fetch_array($resuilt))
{
?>
<tr>
<td class="row" height="50" align="center"><?php echo $row['nID'];?></td>
<td class="row" align="center">
<a  style="color:#FF0000"href="admin.php?go=news_detail&action=detail&nid=<?php echo($row['nID']);?>"><?php echo $row['nName'];?></a></td>
<td class="row" align="center"><img  height="50" width="80"src="../newspicture/<?php echo $row['nImage'];?> " /></td>
<td class="row" align="center"><?php echo $row['newDate'];?></td>
<td class="row" align="center">
<select name="newStatus" onchange="location.href='admin.php?go=news_list&action=change&nid=<?php echo $row['nID'];?>&status='+this.value;">
<?php if($row['status']==1) {?>
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php } else {?>

<option value="0">Ẩn</option>
<option value="1">Hiện</option>
</select><?php }?>	</td>
<td class="row" width="6%" align="center"><a href="admin.php?go=news_edit&action=update&nid=<?php echo $row['nID'];?>">Sửa</a></td>
<td class="row" width="6%" align="center"><a href="admin.php?go=news_list&action=del&nid=<?php echo $row['nID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a></td>
</tr>
<?php }?>
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

$action=$_REQUEST['action'];

if($action=="del")
{
$sql_del="Delete From news where nID=".$_REQUEST['nid'];

if(mysql_query($sql_del,$connect))
{
echo ('<script>alert("Đã xóa xong!");</script>');
echo("<script>window.location='admin.php?go=news_list';</script>");
}
}

if($action=="change")
{
$sql_update="Update news set status=".$_REQUEST['status']." where nID=".$_REQUEST['nid'];
if(mysql_query($sql_update,$connect))
{
echo("<script>window.location='admin.php?go=news_list';</script>");
}
}
?>
