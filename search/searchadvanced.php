<div id="contpro">
    <div id="left_menu">
    	<?php include('include/best_sale.php'); ?>
    </div>
    	<?
		if($_REQUEST['act']=="search" )
		{
			$IDprice=$_SESSION['price'];
			$category=$_SESSION['category'];
			$supplier=$_SESSION['supplier'];
			$group_category=$_SESSION['group_category'];	
		}	
		?>
		<?
		if($_REQUEST['act']=="search")
		{
			//echo("Ket qua la :");
			$record_per_page = 9;
			$pagenum = $_GET["page"];
			$page = "index.php?go=searchadvanced&act=search";
			?>
			<?
			$expression=" 1 ";
			
			if($category != 0)
			{
				$expression =$expression." and category.cateID =".$category;
				$page =$page."&category=".$category;
			}
			else
			{
				if($group_category==0)
				{
				}
				else
				{
					$expression =$expression." and category.gpCateID =".$group_category;
				}	
			}
			if($supplier != 0)
			{
				$expression =$expression." and supplier.subID =".$supplier;
				$page =$page."&supplier=".$supplier;
			}
		
			// Tìm kho?ng giá yêu c?u
			if($IDprice!=0)
			{
				$sql_maxprice="select max(seaID) as maxID from search";
				$result_maxprice=mysql_query($sql_maxprice,$connect);
				while($row_maxprice=mysql_fetch_array($result_maxprice))
				{
					$check=$row_maxprice['maxID'];
				}
				$sql_price="select * from search where seaID=".$IDprice;
				$result_fromto=mysql_query($sql_price,$connect);
				if($result_fromto)
				{
					while($row_fromto=mysql_fetch_array($result_fromto))
					{
						if($row_fromto['seaID']==$check)
						{
							$fromprice=$row_fromto['fromPrice'];
							$toprice=0;
						}
						else
						{
							$fromprice=$row_fromto['fromPrice'];
							$toprice=$row_fromto['toPrice'];
						}
					}
					if($toprice==0)
					{
						$expression =$expression." and product.priceSale > ".$fromprice;
					}
					else
					{
						$expression =$expression." and product.priceSale > ".$fromprice;
						$expression =$expression." and product.priceSale < ".$toprice;
					}
				}		
		}
		
		?>
		
		<?
		$sql = "SELECT  *   
		FROM         Category INNER JOIN
		product_category ON Category.cateID = product_category.cateID INNER JOIN product ON product_category.proID=product.proID INNER JOIN
		supplier ON product.subID=supplier.subID Where " .$expression." and product.status=1 Order By product.postTime DESC" ;
		$re=mysql_query($sql,$connect);
		if($re)
		{
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
		}
		else
		{
		?>
			<script> alert('Không k?t n?i du?c co s? d? li?u'); </script>
		<?php 
		}
		?>
    <div id="contant_product">
    	<div id="ketqua_tk"><strong>Kết quả tìm kiếm có :<?php echo("<font color='red'> $num </font>"); ?> sản phẩm</strong></div>
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
			<?
			if($i%3!=0)
			/*echo("</tr>");*/
			?>
        </div><!--contant_sea-->
        				<div class="clear"></div>
                        
            <div id="page">
        	<?
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
        <?
		}else{
		?>
		Sản phẩm đang cập nhật
		<?
		}
		?>
        
        

        
        
        
        
    </div><!--contant_product-->

    <div id="right_menu">
    	<?php  require("include/menu_news.php");?>
		<?php require('include/menu_support.php');?>
    </div>
</div>
