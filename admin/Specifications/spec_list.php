<?php
$record_per_page = 15;
$pagenum = $_GET["page"];
$page = "admin.php?go=spec_list";
?>
<?php
$sql="Select * from attribute order by attID Desc";
$resuilt=mysql_query($sql,$connect);	
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="4" align="center" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH THÔNG SỐ KỸ THUẬT </span></td>
</tr>
<tr>
<td class="row_one" width="16%" align="center">Mã thông số </td>
<td class="row_one" width="69%" align="center">Tên Thông số </td>
<td class="row_one" colspan="2" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
while($row=mysql_fetch_array($resuilt))
{
?>
<tr>
<td class="row" align="center"><?php echo $row['attID'];?></td>
<td class="row" align="center"><?php echo $row['attName'];?></td>
<td class="row" width="7%" align="center"><a href="admin.php?go=spec_edit&action=update&specID=<?php echo $row['attID'];?>">Sửa</a></td>
<td class="row" width="8%" align="center">
<?php
$sql_check="select * from att_product where attID=".$row['attID']." and att_value !=''";
$rel=mysql_query($sql_check,$connect);
if(mysql_num_rows($rel)>0)
{
echo("|||");
}
else{
?>
<a href="admin.php?go=spec_list&action=del&specID=<?php echo $row['attID'];?>" onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php } ?>
</td>
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
$sql_del="Delete From attribute where attID=".$_REQUEST['specID'];
//$sql_del_prospec ="DELETE FROM prospec WHERE specID =".$_REQUEST['specID'];

if(mysql_query($sql_del,$connect))
{
//if(mysql_query($sql_del_prospec,$connect))
//{
	echo ('<script>alert("Đã xóa xong!");</script>');
	echo("<script>window.location='admin.php?go=spec_list';</script>");	
//}
}
}

?>
