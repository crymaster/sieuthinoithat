<?php
$record_per_page =10;
$pagenum = $_GET["page"];
?>
<?php
$page = "admin.php?go=feelist";
	$_SESSION['url']="index.php?go=feelist";
   $sql="select customers.*, feedback.*  from customers , feedback where customers.cID=feedback.cID order by feeID desc ";
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

<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellpadding="3" cellspacing="3" >
<tr>
<th height="50" colspan="7"  scope="col" background="../media/banner_l.jpg"><span class="style1">DANH SÁCH PHẢN HỒI</span></th>
</tr>
<tr>
<td class="row_one" width="11%" align="center"  scope="col">Tên tài khoản</td>
<td class="row_one" width="16%" align="center"  scope="col">Tiêu đề</td>
<td class="row_one" width="44%" align="center"  scope="col">Nội dung</td>
<td class="row_one" width="15%" align="center"  scope="col">Phản hồi cho sản phẩm </td>
<td class="row_one" width="7%" align="center"  scope="col">Trạng thái</td>
<td class="row_one" width="7%" colspan="2" align="center" scope="col"><img src="media/s_fulltext.png" width="50" height="19" /></td>
</tr>
<?php
while($row=mysql_fetch_array($re))
{
?>
<tr>
<td class="row" align="center"><?php echo($row['cUser']);?></td>
<td class="row" align="center"><?php echo($row['feeTitel']);?></td>
<td class="row" align="left"><?php echo($row['feeContent']);?></td>

<?php
$sql = "select * from feedback,product where feedback.proID=product.proID and feedback.proID=".$row['proID'];
$result=mysql_query($sql,$connect);
$row_pro=mysql_fetch_array($result);
?>
<td class="row" align="center"><?php echo $row_pro['proName'];?></td>


<td class="row" align="center">

<select name="feedStatus" onChange="location.href='admin.php?go=feelist&action=update&fid=<?php echo($row['feeID'])?>&status='+this.value">
<?php
if($row['status']==1)
{
?>  
<option value="1">Hiện</option>
<option value="0">Ẩn</option>
<?php
}else{
?>
<option value="0">Ẩn</option>
<option value="1">Hiện</option>
<?php
}
?>
</select></td>
<td class="row" align="center"><a href="admin.php?go=feelist&action=feedel&fid=<?php echo($row['feeID'])?> "  onclick="if(confirm('Bạn chắc chắn?')) return true; else return false;" >Xóa</a></td>
</tr>
<?php
}
?>
</table>

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

</form>
<?php
	$action=$_REQUEST['action'];
	$feeid=$_REQUEST['fid'];
	$status=$_REQUEST['status'];
	if($action=='update')
	{
		$sql="Update feedback set status=".$status." where feeID=".$feeid."";
		if(mysql_query($sql,$connect))
		{
			echo("<script>window.location='admin.php?go=feelist';</script>");	
		}	
	}
	if($action=='feedel')
	{
	   $sql="delete from feedback where feeID=".$feeid;
	   if(mysql_query($sql,$connect))
	   {
	   echo("<script> alert('Đã xóa xong');</script>");
	   echo("<script>window.location='admin.php?go=feelist';</script>");	
	   }
	}
	
?>
