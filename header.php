<div id="wapper">
	<div id="header">
    	<div id="logo">
        </div><!--End #logo-->
        
        <div id="banner">
        </div><!--End #banner-->
        
        <div id="login">
        	<div id="waplog">
        	<div id="shoppingcate">
               	<ul>
                	<li id="ico_cart"><a href="index.php?go=shoppingcart"> <img src="images/ico_cart.png" />  </a></li>
                	<li id="quantity" style="margin:-5px 0px 0px 5px;"><span id="sanpham"><?php echo $_SESSION['Count']; ?> <a href="index.php?go=shoppingcart"> sản phẩm  </a></span></li>          
                </ul>
            </div><!--End #shoppingcate-->
			<?php
			 if(isset($_SESSION['CusUser']))
			 {
			?>
			
			 <div id="logon">
            	<ul>
				    <li>Xin chào : <?php echo $_SESSION['CusUser'];?></li>
					<li><img src="images/line_header_s.jpg" /></li>
                	<li><a href="index.php?go=logout" onClick="if(confirm('Bạn có chắc chắn muốn đăng xuất !')) return true;else return false;">Đăng xuất</a></li>
                    <li><img src="images/line_header_s.jpg" /></li>
                    <li><a href="index.php?go=profile">Hồ sơ</a></li>
            
                </ul>
            </div><!--End #logon-->
			<?php
			 }
			 else
			 {
			?>
            <div id="logon">
            	<ul>
                	<li><a href="index.php?go=login">Đăng nhập</a></li>
                    <li><img src="images/line_header_s.jpg" /></li>
                    <li><a href="index.php?go=register">Đăng ký</a></li>
                  
                </ul>
            </div><!--End #logon-->
			<?php
			 }
			?>
           </div><!--End #waplog-->
        </div><!--End #login-->
        		<div class="clear"></div><!--End .clear-->
                <div id="line">
                </div><!--End #line-->
				<?php include('menu/menu_bar.php')?>
        
        <!--End #menubar-->

    </div><!--End #header-->
