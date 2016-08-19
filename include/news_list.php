<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td  id="titel_page" height="44" style="text-align:center;font-weight:bold; font-size:16px"> Tin Tức</td>
	<td width="10" rowspan="2">&nbsp;</td>
	<td width="159" align="center" valign="top" bgcolor="#FFFFFF" rowspan="2">
	<?php require("include/menu_news.php");?><br />
	 <?php require("include/menu_support.php");?>
	</td>
</tr>
<tr>


<td width="620" align="center" valign="top">
		<?php
		$record_per_page = 7;
		$pagenum = $_GET["page"];
		$page = "index.php?go=news_list";
		?>
		
		
		<?php
		$sql="Select * from news where status = 1 order by newDate desc";
		$resuilt=mysql_query($sql);
		
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
		$resuilt=mysql_query($sql)
		
		?>
		
		<table class="borderAllTable"  width="100%" border="0" >
		<tr>
		<td>
		
		<?php
		while($row=mysql_fetch_array($resuilt))
		{
		?>
		<table  width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
		<td width="32%" rowspan="3" >
		<!--	table image-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td height="80" align="center"><img border="2"  height="100" width="170"src="newspicture/<?php echo $row['nImage'];?> " /></td>
		</tr>
		</table>
		
		</td>
		<td width="68%" height="20" align="left" valign="bottom"><div  class="timnangcao"><a href="index.php?go=news_detail&newid=<?php echo $row['nID'];?>"><?php echo $row['nName'];?></a></div></td>
		</tr>
		<tr>
		<td height="50" valign="top"><?php echo $row['nHeader'];?></td>
		</tr>
		<tr>
		<td height="10" align="right"><div class="top"><a href="index.php?go=news_detail&newid=<?php echo $row['nID'];?>">Xem tiếp</a>&nbsp;</td>
		</tr>
		</table>
		<hr class="hr"/>
		
		<?php }?>	
		</td>
		</tr>
		</table>
		
		
		<div  id="pagenum"align="right">
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
		echo "  <a href='".$page."&page=".$i."'><B><font color=red><u>".$i."</u></font></B></a>";
		else
		echo " <a href='".$page."&page=".$i."'>".$i."</a>";
		}
		}
		echo("<font color=red>  &nbsp; &nbsp;(Page: &nbsp; ".$pagenum."&nbsp;/&nbsp;".$totalpage.")");
		?>
		</div>		
</td>


</tr>
</table>

