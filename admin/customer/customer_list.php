<?php
$record_per_page =10;
$pagenum = $_GET["page"];
$oid=$_REQUEST['oid'];
?>
<?php
$page = "index.php?go=customer_list";
	$_SESSION['url']="admin.php?go=customer_list";
if($oid==0)
{
	$sql="select * from customers order by cID desc ";
}
else if($oid==1)
{
	$sql="select * from customers where status = 1 order by cID desc ";
}

else if($oid==2)
{
	$sql="select * from customers where status = 0 order by cID desc ";
}
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

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td height="50" colspan="10"align="center" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH KHÁCH HÀNG</span><br />
<select name="select2" onChange="location.href='admin.php?go=customer_list&oid='+this.value+'&page=<?php echo($pagenum)?>'">
<?php
if($oid==0)
{
?>
<option  value="0" selected="selected">Tất cả khách hàng</option>
<option value="1">Hoạt động</option>
<option value="2">Ngừng Hoạt động</option>
<?php
}
if($oid==1)
{
?>
<option value="1" selected="selected">Hoạt động</option>
<option  value="0" >Tất cả khách hàng</option>
<option value="2">Ngừng Hoạt động</option>
<?php
}
if($oid==2)
{
?>
<option value="2" selected="selected">Ngừng Hoạt động</option>
<option value="1">Hoạt động</option>
<option  value="0" >Tất cả khách hàng</option>
<?php
}
?>
</select>	</td>
</tr>
<tr>
<td class="row_one" width="6%" align="center">Mã KH </td>
<td class="row_one" width="9%" align="center">Tài Khoản </td>
<td class="row_one" width="10%" align="center">Họ tên </td>
<td class="row_one" width="8%" align="center">Điện thoại </td>
<td class="row_one" width="17%" align="center">Địa chỉ </td>
<td class="row_one" width="12%" align="center">Email</td>
<td class="row_one" width="17%" align="center">Câu hỏi </td>
<td class="row_one" width="7%" align="center">Câu trả lời </td>
<td class="row_one" width="9%" align="center">Trạng thái </td>
<td class="row_one" width="5%" align="center"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
while($row=mysql_fetch_array($re))
{
?>
<tr>
<td class="row" align="center"><?php echo $row['cID'];?></td>
<td class="row"><?php echo $row['cUser'];?></td>
<td class="row"><?php echo $row['cName'];?></td>
<td class="row"><?php echo $row['cPhone'];?></td>
<td class="row"><?php echo $row['cAddress'];?></td>
<td class="row"><?php echo $row['cEmail'];?></td>
<?php
$sql = "select * from customers,question where customers.quesID=question.quesID and customers.quesID=".$row['quesID'];
$result=mysql_query($sql,$connect);
$row_ques=mysql_fetch_array($result);
?>
<td class="row" align="center"><?php echo $row_ques['question'];?></td>

<td class="row"><?php echo $row['answer'];?></td>
<td class="row" align="center">     
<select name="select" onchange="location.href='?go=customer_list&action=update&cid=<?php echo($row['cID'])?>&status='+this.value">
<?php if($row['status']==1)
{
?>
<option value="1">unlock</option>
<option value="0">lock</option>
<?php
}
else 
{
?>
<option value="0">lock</option>
<option value="1">unlock</option>
<?php
}
?>
</select>		</td>
<td class="row" align="center">	 <?php
$sql_check="Select * from orders where cID=".$row['cID'];
$re1=mysql_query($sql_check,$connect);
$ok=0;
while($row1=mysql_fetch_array($re1))
{
$ok=1;
}
if($ok==1)
{
echo("|||");
}
else{
?>
<a href="admin.php?go=customer_list&action=del&cusid=<?php echo($row['cID']);?>" onClick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php }?></td>
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
<?php
  $action=$_REQUEST['action'];
  $cusid=$_REQUEST['cid'];
  $cusstatus=$_REQUEST['status'];
  if($action=='update')
  {
     $sql="update customers set status=".$cusstatus." where cID=".$cusid;
	 if(mysql_query($sql,$connect))
	 {
	echo("<script>window.location='admin.php?go=customer_list';</script>");	
	 }
  }
  if($action=='del')
  {
     $cusid=$_REQUEST['cusid'];
	 $sqlfb="delete from feedback where cID=".$cusid;
	 $sql="delete from customers where cID=".$cusid;
	 if(mysql_query($sqlfb,$connect))
	 {
			 if(mysql_query($sql,$connect))
			 {
			echo ('<script>alert("Đã xóa xong!");</script>');
			echo("<script>window.location='admin.php?go=customer_list';</script>");	
			 }
	 }
  }
?>
