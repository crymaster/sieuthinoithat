<div id="contpro">

	<div id="left_menu">
    	<?php include('include/new_Product.php'); ?>
        <?php include('include/best_sale.php');?>
        <?php include('counter/counter.php');  ?>
    </div><!--End left_menu-->
    
    <div id="contant_product">
        <div id="titel_page">
            <?php 
            $sql_titel="select gpCateName FROM group_category where gpCateID=".$_REQUEST['gpCateID'];
            $re=mysql_query($sql_titel); 
            if($rows_titel = mysql_fetch_array($re)){
             echo $rows_titel['gpCateName'];
            }
            ?>
        </div><!--End #title_page-->
     <!------------------------------------------------>   
        
        <?php
		$record_per_page = 9;
		$pagenum = $_GET["page"];
		$page = "index.php?go=product_list&gpCateID=".$_REQUEST['gpCateID'];
		?>
		<?php
		$sql="SELECT product. *,product_category. * ,category.status 
		FROM group_category
		INNER JOIN category ON group_category.gpCateID = category.gpCateID
		INNER JOIN product_category ON category.cateID = product_category.cateID 
		INNER JOIN product ON product_category.proID=product.proID 
		where product.status=1 and category.status=1";
		$gpCateID=$_REQUEST['gpCateID'];//lau ma loai tu URL
		$cateID=$_REQUEST['cateID'];
		
		$sql = $sql . " And group_category.gpCateID=".$gpCateID;
		if(!empty($_REQUEST['cateID']))
		{
			$sql = $sql . " And category.cateID=".$_REQUEST['cateID'];
			$page = $page ."&cateID=".$_REQUEST['cateID'];
		} 
		
		//echo($sql);	
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
			//die();
		$re=mysql_query($sql,$connect);
		?>
		<?php
		if(mysql_num_rows($re))
		{
		?>
        
            <div id="info_product">
                 <!--------bat dau vong lap------->
                <?php
				$i=0;
				while($row=mysql_fetch_array($re))
				{
				?>
                <!--------lap------->
                    <div class="detail_p">
                    	<div id="name_product">
                        	<span class="name"><a href="index.php?go=product_detail&cateID=<?php echo $row['cateID'];?>&pid=<?php echo $row['proID']; ?>&gpCateID=<?php echo $gpCateID; ?>"><?php echo($row['proName'])?></a></span>
                        </div>
                        <div id="img_product">
                        	<img class="magnify"  magnifyby="3" src="image/<?php echo($row['images'])?>"width="200" height="160" alt="Product image" border="0"  title="<?php echo($row['proDes']);?>"   />
                        </div>
                        <div id="price">
                        	<span class="price"><?php echo(number_format($row['priceSale']));?> VND		</span>
                        </div>
                        <div id="deital">
                        	<a href="index.php?go=product_detail&cateID=<?php echo $row['cateID'];?>&pid=<?php echo($row['proID'])?>&gpCateID=<?php echo $gpCateID; ?>"> <img src="media/detail.jpg" border="0" /></a>
						    <a href="index.php?go=shoppingcart&action=add&pid=<?php echo $row['proID']; ?>"><img src="media/buy.jpg" border="0" /></a>
                        </div>
                    
                    </div>
                <!--------lap------->
                <?php
				$i++;
				if($i%3==0)
				echo("</tr>");
				?>
				<?php
				}
				?>
				<?php
				if($i%3!=0)
				echo("</tr>");
				?>
				<!--------ket thuc vong lap------->
                
                
            </div><!--End #info_product-->
        <?php
		}else{
		?>
		Sản phẩm đang cập nhật
		<?php
		}
		?>	
        		<div class="clear"></div>
        <div id="page">
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
			echo "<a href='".$page."&page=".$i."'>".$i."</a>";
			}
			}
			echo("<font color=red>  &nbsp; &nbsp;(Page: &nbsp; ".$pagenum."&nbsp;/&nbsp;".$totalpage.")");
			?>
        </div>
        
    </div><!--End #contant_product-->
		     <!------------------------------------------------>  		
    
    <div id="right_menu">
    	<?php require("menu/sitebar.php");?>
    </div><!--End left_menu-->
  
    
</div><!--End #contpro-->
