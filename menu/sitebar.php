

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="clear"></div>
<div id="gr_meunbar">		
                    <div id="sitebar">
        
                        <div class="sitebar_detail">
                                    <div id="titel_sitebar">
                                        <p class="titel_info">Dòng Sản Phẩm</p>
                                    </div><!--End #titel_sitebar-->
                                    
                                    <div class="line_sitebar">
                                    </div><!--End .line_sitebar-->
													<?php
														$gpCate=$_REQUEST['gpCateID'];
														$sql_selectCateID="select * from category where status=1 and gpCateID=".$gpCate;
														$result_selectCateID=mysql_query($sql_selectCateID,$connect);
														if($result_selectCateID)
														{
															while($row_selectCateID=mysql_fetch_array($result_selectCateID))
															{ ?>
																<div class="sitebar_info">
                                                        		<a href="index.php?go=product_list&gpCateID=<?php echo $gpCate; ?>&cateID=<?php echo $row_selectCateID['cateID']; ?>"><strong><?php echo $row_selectCateID['cateName']; ?></strong></a>
                                                   				 </div>
															
													<?php		}
														}
													
													?>
                            </div><!--End .sitebar_detail-->
                        
              <!------------------------------------------------->  
     <div class="clear"></div>           
             
                            <div class="sitebar_detail">
                            	<?php
									require('search/Form_searchadvanced.php');
								?>
                            </div><!--End .sitebar_detail-->
           <!---------------------------------------------------->   
           <div class="clear"></div>
                             <div class="sitebar_detail">
                            	<?php
									require("include/menu_support.php");
								?>
                            </div><!--End .sitebar_detail-->
                        
                    </div><!--End #sitebar-->
            </div><!--End #gr_meunbar-->
