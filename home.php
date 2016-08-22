<link rel="stylesheet" type="text/css" href="css/style_home.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="css/owl.theme.css" />
<script type="text/javascript" src="javascript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="javascript/home.js"></script>
<script type="text/javascript" src="javascript/owl.carousel.js"></script>

<div id="conten_home">
	<!-- <div id="big_img">
		<embed src="~banner.swf".swf" type="application/x-shockwave-flash" wmode="transparent" width="1000" height="488">
	</div><!--End #big_img--> 
	<div class="welcome">
		<div class="title_recommend_item">Sản phẩm bạn có thể quan tâm</div>
	</div>
	
	<div class="clear"></div>
	
	<div id="slide">
		<?php
		foreach ($data['product_list'] as $product) {
			echo "<div class='item'><a class='item_text' href='index.php?go=product_detail&cateID=$product->cateID&pid=$product->proID&gpCateID=$product->gpCateID' ><img src='image/$product->images' alt='$product->proName'><div>$product->proName</div></a></div>";	
		} ?>
	</div>
	
	<div id="img_cate">
			<div class="img_gp_category">
				<a href="index.php?go=product_list&gpCateID=11&cateID"><img src="images/img_phongan.png" /></a>
			</div><!--End .img_gp_category-->
			<div class="img_gp_category">
				<a href="index.php?go=product_list&gpCateID=12&cateID"><img src="images/img_phonglamviec.png" /></a>
			</div><!--End .img_gp_category-->
			<div class="img_gp_category">
				<a href="index.php?go=product_list&gpCateID=9&cateID"><img src="images/img_phongkhach.png" /></a>
			</div><!--End .img_gp_category-->
			<div class="img_gp_category" id="right_ex">
				<a href="index.php?go=product_list&gpCateID=10&cateID"><img src="images/phongngu.png" /></a>
			</div><!--End .img_gp_category-->
	 </div><!--End #img_cate-->  
 	
 	<div class="clear"></div> 

	<div class="welcome">
		<div class="titel_welcome">WELCOME
		</div><!--End .welcome-->
		<div class="review" style="font-size:15px">
		Dịch vụ tư vấn thiết kế của chúng tôi dựa vào nhu cầu cụ thể của từng dự án từ nhà ở đến kinh doanh như nhà hàng, khách sạn, spa, showroom… 
			Chúng tôi luôn xem xét các dự án từ nhiều góc độ, ưu tiên nghiên cứu các phương án phù hợp nhằm đưa ra giải pháp tối ưu cho khách hàng.
		<br>
		<br>
			Với sự dày dặn kinh nghiệm của các chuyên gia kiến trúc sư đã có nhiều năm làm việc tại các công ty nước ngoài và các kỹ sư có năng lực chuyên môn 
			cao được đào tạo chuyên nghiệp chúng tôi đủ sức đảm nhiệm các dự án tư vấn thiết kế xây dựng, nội ngoại thất theo tiêu chuẩn quốc tế.
		</div><!--End .welcome-->
	</div><!--End .welcome-->
</div><!--End #conten_home-->