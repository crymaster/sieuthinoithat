<?php
$record_per_page =10;
$pagenum = $_GET["page"];
$oid=$_REQUEST['oid'];
?>
<?php
$page = "admin.php?go=ordlist";
$_SESSION['url']="admin.php?go=ordlist";
if($oid==0)	
{
	$sql="select customers.* , orders.* from orders , customers where customers.cID= orders.cID order by oDateCreate desc ";
}
else if($oid ==1)
{
	$sql="select customers.* , orders.* from orders , customers where customers.cID= orders.cID and orders.status = 1 order by oDateCreate desc "; 
}
else if($oid ==2)
{
	$sql="select customers.* , orders.* from orders , customers where customers.cID= orders.cID and orders.status = 2 order by oDateCreate desc "; 
}
else if($oid ==3)
{
	$sql="select customers.* , orders.* from orders , customers where customers.cID= orders.cID and orders.status = 3 order by oDateCreate desc "; 
}

	$re=mysql_query($sql,$connect);	
	
		$totalpage =@ceil( mysql_num_rows($re) / $record_per_page);
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

<form name="form1" method="post" action="">
<table width="100%" border="0" cellpadding="3" cellspacing="3" >
<tr>
<td height="50" colspan="6" align="center" valign="middle" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH HÓA ĐƠN</span></td>    </tr>
<tr>
<td class="row" colspan="6" align="center" valign="middle"  scope="col">Trạng thái hoá đơn :
<select class="style_text" name="select"onChange="location.href='admin.php?go=ordlist&oid='+this.value+'&page=<?php echo($pagenum)?>'">
<?php
if($oid==0)
{
?>
<option value="0" selected="selected">Tất cả các hoá đơn</option>
<option value="1">Hoá đơn chưa xử lý</option>
<option value="2">Hoá đơn đang xử lý</option>
<option value="3">Hoá đơn đã xử lý</option>
<?php
}
if($oid==1)
{
?>
<option value="0">Tất cả các hoá đơn</option>
<option value="1" selected="selected">Hoá đơn chưa xử lý</option>
<option value="2">Hoá đơn đang xử lý</option>
<option value="3">Hoá đơn đã sử lý</option>
<?php
}
if($oid==2)
{
?>
<option value="0">Tất cả các hoá đơn</option>
<option value="1">Hoá đơn chưa xử lý</option>
<option value="2"  selected="selected">Hoá đơn đang xử lý</option>
<option value="3">Hoá đơn đã xử lý</option>
<?php
}
if($oid==3)
{
?>
<option value="0">Tất cả các hoá đơn</option>
<option value="1">Hoá đơn chưa xử lý</option>
<option value="2" >Hoá đơn đang xử lý</option>
<option value="3" selected="selected">Hoá đơn đã sử lý</option>
<?php
}
?>
</select>
</label>
</div></td>
</tr>
<tr>
<td class="row_one" width="19%" height="45" align="center" valign="middle" scope="col">Khách hàng</td>
<td class="row_one" width="24%" align="center" valign="middle" scope="col">Ngày Mua</td>
<td class="row_one" width="20%" align="center" valign="middle" scope="col">Ngày giao hàng</td>
<td class="row_one" width="17%" align="center" valign="middle" scope="col">Trạng thái </td>
<td class="row_one" colspan="2" align="center" valign="middle" scope="col"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php 


	while(@$row=mysql_fetch_array($re))
	{
		?>
		<tr>
		<td align="center" class="row"><?php echo($row['cName']);?></td>
		<td align="center" class="row"><?php echo($row['oDateCreate']);?></td>
		<td align="center" class="row"><?php echo($row['oShipDate']);?></td>
		<td class="row" align="center">
	
		<select class="style_text" name="ordStatus" onChange="location.href='?go=ordlist&action=update&oid=<?php echo($row['oID'])?>&status='+this.value">
		<?php
		if($row['status']==3)
		{
		?>
		<option value="3">Đã xử lý</option>
		<?php
		}else{
		if($row['status']==2){
		?>
		<option value="2">Đang xử lý</option>
		<option value="3">Đã sử lý</option>
		<?php
		}else{
		?>
		<option value="1">Chưa xử lý</option>
		<option value="2">Đang xử lý </option>
		<?php
}} 
?>
</select>      </td>
<td class="row" width="10%" align="center" valign="middle"><div align="center">
<?php
if($row['status']==1 || $row['status']==2)
{
?>
<a href="admin.php?go=ordlist&action=del&oid=<?php echo($row['oID']);?>"  onClick="if(confirm('Bạn chắc chắn?')) return true; else return false;">Xóa</a>
<?php
}
else echo("|||");
?>
</div></td>
<td class="row" width="10%" align="center" valign="middle"><div align="center"><a href="admin.php?go=orddetail&oid=<?php echo($row['oID']);?>">Xem</a></div></td>
</tr>
<?php
}
?>
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
$ordid=$_REQUEST['oid'];
$status=$_REQUEST['status'];
if($action=='update')
{
$sql="Update orders set status=".$status." where oID=".$ordid."";
$sql11="Update orderdetail set status=".$status." where oID=".$ordid."";
if(mysql_query($sql,$connect) && mysql_query($sql11,$connect))
{
echo("<script> alert('Cập nhật trạng thái thành công ');</script>");
echo("<script>window.location='admin.php?go=ordlist';</script>");	

}	
}
if($action=='del')
{
$ordid=$_REQUEST['oid'];
$sql="delete from orders where oID=".$ordid;
$sql1=" Delete from orderdetail where oID=".$ordid;
if(mysql_query($sql,$connect))
{
if(mysql_query($sql1,$connect))
{
	echo("<script> alert('Đã xóa xong');</script>");
	redirect("admin.php?go=ordlist");
}
}
}
?>
