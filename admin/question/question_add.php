
<?
$action=$_REQUEST['action'];
if($action=='add')
{
$question=$_REQUEST['question'];

$sql="select * from question where question='".$question."'";
$re=mysql_query($sql,$connect);
$num=mysql_num_rows($re);
if($num>=1)
{
echo("<script>alert('Tên đã có trong CSDL ');</script>");
}
else
{
$sql_add="insert into question(question) values ('".$question."')";

if(mysql_query($sql_add,$connect))
{
echo("<script> alert('Đã thêm mới');</script>");
echo("<script>window.location='admin.php?go=question_list';</script>");	
}
}
}
?>
<form action="?go=question_add&action=add" method="post" name="frmadd" id="frmadd" onsubmit="return CheckFormQues()">
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THÊM CÂU HỎI BẢO MẬT</span></td>
</tr>
<tr>
<td class="row" width="40%" align="right">Nội dung </td>
<td class="row" align="left"><input name="question" id="question" type="text" size="60">
</td>
</tr>
<tr>
<td class="row" align="right"><input type="submit" name="Submit" value="Thêm mới"></td>
<td class="row" align="left"><input type="reset" name="Submit2" value="Nhập lại">
</td>
</tr>
</table>
</form>