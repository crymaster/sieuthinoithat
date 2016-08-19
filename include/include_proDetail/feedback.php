<div id='img2' style='display:none'>
<?php
			$sql="select * from feedback , customers  where feedback.cID = customers.cID and 
			 feedback.status =1 and proID =".$proid." order by feeDate desc ";
			$re = mysql_query($sql,$connect);
			$num=mysql_num_rows($re);
			?>
<?php if($num>=1) {?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td align="left" valign="top">
		<span style="padding:2px; font-size:18px; color: #666666"> 
		<img src="media/review_pen.gif" width="28" height="23" />Ý kiến khách hàng:</span>
		<div id="scroll_box">
		<?php  while($row=mysql_fetch_array($re)){ ?>
		<span class="feed_username"><?php echo($row['cUser']);?></span> :<br />
		<span class="feed_title"><?php echo($row['feeTitel']);?>:</span> <br />
		<?php echo($row['feeContent']);?> <br />
		(<span class="fedd_cusmail"><?php echo($row['cEmail']);?></span>)
		<hr  class="hr"/>
		<?php }?>
		</div>
	</td>
	</tr>
	</table>
<?php } else {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" valign="middle">CHƯA CÓ BÌNH LUẬN CHO SẢN PHẨM NÀY</td>
  </tr>
</table>

<?php }?>
</div>
