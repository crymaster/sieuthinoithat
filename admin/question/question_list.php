<?php
$sql="select * from question order by quesID desc ";
$resuilt= mysql_query($sql,$connect);

?>
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="3" background="../media/banner_l.jpg" align="center"><span class="style1">DANH SÁCH CÂU HỎI BẢO MẬT </span></td>
</tr>
<tr>
<td class="row_one" width="21%" align="center">Mã câu hỏi </td>
<td class="row_one" width="67%" align="center">Nội dung câu hỏi </td>
<td class="row_one" width="12%" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
while($row=mysql_fetch_array($resuilt))
{
?>
<tr>
<td class="row" align="center"><?php echo $row['quesID'];?></td>
<td class="row" align="left"><?php echo $row['question'];?></td>
<td class="row" align="center">
<?php
$sql_check="select * from customers where quesID=".$row['quesID'];
$rel=mysql_query($sql_check,$connect);
if(mysql_num_rows($rel)>0)
{
echo("|||");
}
else{
?>
<a href="admin.php?go=question_list&action=delete&quesID=<?php echo($row['quesID']);?>"  onClick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php
}
?>


</td>
</tr>
<?php }?>
</table>
<?php
$action=$_REQUEST['action'];
$quesID = $_REQUEST['quesID'];

if($action=='delete')
{
$sql_delete="delete from question where quesID = ".$quesID;
if(mysql_query($sql_delete,$connect))
{
echo("<script> alert('Đã xóa xong');</script>");
echo("<script>window.location='admin.php?go=question_list';</script>");	
}
}
?> 
