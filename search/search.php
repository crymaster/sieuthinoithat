<div id="contpro">
    <div id="left_menu">
    	<?php include('include/best_sale.php'); ?>
    </div>
    	<?php
		$record_per_page = 9;
		$pagenum = $_GET["page"];
		$page = "index.php?go=search&keyword=".$keyword;
		?>
		<?php
		$sql = "SELECT Product. *,product_category. *,group_category. *
		FROM group_category
		INNER JOIN category ON group_category.gpCateID = category.gpCateID
		INNER JOIN product_category ON category.cateID = product_category.cateID 
		INNER JOIN product ON product_category.proID=product.proID 
		where product.status=1 and product.proName Like '%".$keyword."%' order by postTime desc ";
		//echo($sql);	
		$re=mysql_query($sql,$connect);
		$num=mysql_num_rows($re);
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
		
		$re=mysql_query($sql,$connect);
		$self = $page;
		?>
		
	    <div id="contant_product">	
		<?php
		$keyword=$_REQUEST['keyword'];
		echo('<h2>Tên sản phẩm chứa :&nbsp;<i style="color:red">'.$keyword.'</i></h2>');
		?>
		
		
		
		
		
		<?php
		if(mysql_num_rows($re))
		{
		?>


    	<?php if($num>0) {?>
		<div id="ketqua_tk"><strong>Kết quả tìm kiếm có :<?php echo("<font color='red'> $num </font>"); ?> sản phẩm</strong></div>
		<?php }?>
    	
        <div id="info_product">
        	<?php
			$i=0;
			while($row=mysql_fetch_array($re))
			{
			?>
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
                        	<a href="index.php?go=product_detail&cateID=<?php echo $row['cateID'];?>&pid=<?php echo($row['proID'])?>&gpCateID=<?php echo $row['gpCateID']; ?>"> <img src="media/detail.jpg" border="0" /></a>
						    <a href="index.php?go=shoppingcart&action=add&pid=<?php echo $row['proID']; ?>"><img src="media/buy.jpg" border="0" /></a>
                        </div>
                    
                    </div>
        	<?php
			$i++;
			if($i%3==0)
			/*echo("</tr>");*/
			?>
			<?php
			}
			?>
			<?php
			if($i%3!=0)
			/*echo("</tr>");*/
			?>
        </div><!--contant_sea-->
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
        <?php
		}else{
		?>
		không tìn thấy sản phẩm nào.
		<?php
		}
		?>
        
        

        
        
        
        
    </div><!--contant_product-->

    <div id="right_menu">
    	<?php  require("include/menu_news.php");?>
		<?php require('include/menu_support.php');?>
    </div>
</div>
