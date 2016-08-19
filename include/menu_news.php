
<?php
$sql ="select * from news where status = 1 order by newDate desc limit 0,5";
$resuilt = mysql_query($sql); 
?>

<table width="100%" border="0" class="borderAllTable" cellspacing="0" cellpadding="0">
<tr height="33px"><th background="images/black_mosaic_by_seikq.jpg" style="color:#fff;">
Tin Nổi Bật
</th>
</tr>
<tr>
<td bgcolor="#FFFFFF">
<?php
while($row=mysql_fetch_array($resuilt))
{
?>
<ul class="menunews">
<li>

<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td >

<a href="index.php?go=news_detail&newid=<?php echo $row['nID'];?>">
<img border="0"  height="60" width="70"src="newspicture/<?php echo $row['nImage'];?> " /></a></td>
<td>
<a href="index.php?go=news_detail&newid=<?php echo $row['nID'];?>">
<?php echo $row['nName'];?>
</a></td>
</tr>
</table>



</li>
</ul>
<?php }?>
</td>
</tr>
</table>








