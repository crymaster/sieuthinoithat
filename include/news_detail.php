<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>

<td width="500" align="center" valign="top">

		<?php
		
		$newid=$_REQUEST['newid'];
		$sql=mysql_query("select * from news where nID = ".$newid);
		?>
		<table width="830px"  align="center" class="borderAllTable"border="0" cellspacing="3" cellpadding="0">
		<tr>
		<td><?php
		while($row=mysql_fetch_array($sql))
		{
		?>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td align="center"><div id="title"><?php echo($row['nName']);?></div></td>
		</tr>
		<tr>
		<td align="left"><div class="header"><?php echo($row['nHeader']);?></div></td>
		</tr>
		
		<tr>
		<td height="350" align="center"><img  border="1"src="newspicture/<?php echo($row['nImage']);?>" width="500" height="300" /></td>
		</tr>
		<tr>
		<td height="30" align="left"><div class="content"><?php echo($row['nContent']);?></div>
		<label></label>          <label></label></td>
		</tr>
		<tr>
		<td height="30" align="right" valign="top"><div class="datetime"> Ngày tháng:<?php echo($row['newDate']);?></div></td>
		</tr>
		</table>
		<?php }?></td>
		</tr>
	  </table>
		
		
		<style type="text/css">
		#title{
		font-family:"Times New Roman", Times, serif;
		font-size:30px;
		color:#FF0000;
		font-style:italic;
		}
		.datetime{
		font-family:"Times New Roman", Times, serif;
		text-decoration:none;
		color: #333333;
		font-style:italic;
		font-size:14px;
		}
		.status{
		font-family:"Times New Roman", Times, serif;
		text-decoration:none;
		color: #333333;
		font-style:italic;
		font-size:16px;
		}
		.header{
		font-family:"Times New Roman", Times, serif;
		text-decoration:none;
		color: #000000;
		font-style:italic;
		font-size:20px;
		}
		.content{
		font-family:"Times New Roman", Times, serif;
		text-decoration:none;
		color: #000000;
		font-size:14px;
		text-align:justify;
		}
		</style>
		

</td>

<td width="10">&nbsp;</td>
<td width="159" align="center" valign="top">

<?php require("include/menu_news.php");?>
</td>
</tr>
</table>

