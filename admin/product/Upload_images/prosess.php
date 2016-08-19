<?php

require_once 'upload.class.inheritance.php';
//require_once 'upload.class.php';
$ID = $_REQUEST['ID'];
if(!empty($_POST))
{
	$num = $_REQUEST['num']; // Lay gia tri so file upload dc tao ra qua action cua Form 
	//echo "<br>".$num;die();
	for($i=1;$i<=$num;$i++)
	{
			$upload = new Upload_insert("img".$i."");
			
/*			echo "THONG TIN DOI TUONG UPLOAD KHI DUOC KHOI TAO(image$i)";
			echo "<pre>";
			print_r($upload);
			echo "<pre>";*/
			
			$upload->setUploadDir('image_product_detail/'); //thu muc ben ngoai admin
			$upload->checkFileSize(1000);
			$upload->checkFileType('gif|jpg|png'); 

			if($upload->isVail() == false){
			
				$comment = $_REQUEST["text".$i.""]; //lay value cua textbox
				$title   = $_REQUEST["title".$i.""];
				
				$upload->upload_insert_image('image',$comment,$ID,$title);
				}
			else{
			echo "<pre>";
			print_r($upload->_errors);
			echo "<pre>";
				}

	
	
	}
}
else
{
	echo "Vui long chon hinh truoc khi truy cap vao trang nay";
}
?>