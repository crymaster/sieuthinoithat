<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div id="menu">
    <ul>
        <li><a href="index.php?go=home">Trang Chủ</a></li>
        	 <li class="img_line"><img src="images/line_header_s.jpg" /></li>
		<?php
			$sql_gp="select * from group_category where status=1 limit 0,4";
			$result_gp=mysql_query($sql_gp,$connect);
			$sql_gp_check="select * from group_category where status=1";
			$result_gp_check=mysql_query($sql_gp_check,$connect);
			$result_count=mysql_num_rows($result_gp_check);
			//echo $result_count;
			$temp=0;
			if($result_gp)
			{
				while($row_gp=mysql_fetch_array($result_gp))
				{
				  	$temp = $row_gp['gpCateID'];
				?>
					
					<li><a href="index.php?go=product_list&gpCateID=<?php echo $row_gp['gpCateID']?>&cateID"><?php echo $row_gp['gpCateName']  ?> </a>
                      <li class="img_line"><img src="images/line_header_s.jpg" /></li>
					</li>		
		<?php		
				}
			}
		?>
        
					<?php
					if($result_count>4)
					{
					?>
			 			<!--<li class="img_line"><img src="images/line_header_s.jpg" /></li>-->
				<li><a href="#">Phòng Khác</a>
					 
					<ul>
                    		<?php
							$sql_gp1="select * from group_category where status=1 and gpCateID >".$temp;
							$sql_result1=mysql_query($sql_gp1,$connect);
							if($sql_result1)
							{
							while($row_sql1=mysql_fetch_array($sql_result1)){
								?>
							
									<li><a href="index.php?go=product_list&gpCateID=<?php echo $row_sql1['gpCateID']; ?>"><?php echo $row_sql1['gpCateName'];  ?> </a></li>
								
							<?php } }
							else
							{
								echo "Loi";
							}
							?>
                    </ul>
					
				</li>
                	<?php }?>
			 <li class="img_line"><img src="images/line_header_s.jpg" /></li>
        <li><a href="index.php?go=news_list">Tin tức</a></li>
        	 <li class="img_line"><img src="images/line_header_s.jpg" /></li>
		<li><a href="index.php?go=googlemap">Bản đồ </a></li>
    </ul>
    <div id="search">
        <?php
			include("search/searchleft.php");
		?>
    </div>
</div>
