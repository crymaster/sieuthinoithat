<?php require_once 'upload.class.php' ?>

<?php
class Upload_insert extends Upload
{
	function upload_insert_image($table,$comment,$ID,$title)
		{
		$prefix=rand(1,100);
		$source = $this->_fileTmp;
		$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
		$name = $prefix.'_' . time() . '.' . $this->_fileExtension;
		$sql="INSERT INTO ".$table."
		VALUES ('',".$ID.",'".$name."','".$title."','".$comment."')";
		//echo $sql; die();
		mysql_query($sql);
		$resuilt = copy($source,$dest);
		echo("<script>window.location='admin.php?go=product_list';</script>");	
		}
		
	function upload_Update($comment,$title,$imgID) 
		{
		//XOA TRUOC KHI UPDATE
		//Xoa file Anh trong thu muc :: image_product_detail
		$sql_img = "select * from image where imgID = $imgID"; 
		$result_img = mysql_query($sql_img);
		$row_img = mysql_fetch_array($result_img);	
		$imgName = $row_img["imgUrl"] ; //ten file can xoa
		$myFile = "image_product_detail/$imgName";
		unlink($myFile); //ham xoa Image


		$prefix=rand(1,100);
		$source = $this->_fileTmp;
		$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
		$name = $prefix.'_' . time() . '.' . $this->_fileExtension;
		$sql = "Update image SET imgUrl = '$name',imgTitle = '$title',imgComment = '$comment'  Where imgID=$imgID";
		mysql_query($sql);
		$resuilt = copy($source,$dest);
		}
		
		
	function upload_insert_procolor($proID,$colorID)
		{
		$prefix=rand(1,100);
		$source = $this->_fileTmp;
		$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
		$name = $prefix.'_' . time() . '.' . $this->_fileExtension;
		$sql = "INSERT INTO procolor VALUES($proID,$colorID,'$name')";
		mysql_query($sql);
		$resuilt = copy($source,$dest);
		}
	function upload_update_procolor($colorID,$proID)
		{
		//Xoa file Anh trong thu muc :: image_product_detail
		$sql_procolor = "select * from procolor where colorID = $colorID and proID = $proID";
		$result_color = mysql_query($sql_procolor);
		$row_procolor = mysql_fetch_array($result_color);	
		$Img = $row_procolor["Img"] ; //ten file can xoa 
		if($Img!=''){
		$myFile = "image_product_detail/$Img";
		unlink($myFile); //ham xoa Image
		}
		
		$prefix=rand(1,100);
		$source = $this->_fileTmp;
		$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
		$name = $prefix.'_' . time() . '.' . $this->_fileExtension;
		$sql = "UPDATE procolor SET Img ='$name' WHERE colorID = $colorID and proID = $proID"; 
		mysql_query($sql);
		$resuilt = copy($source,$dest);
		}
		
		function upload_img_color($colorName)
		{
			$prefix=rand(1,100);
			$source = $this->_fileTmp;
			$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
			$name = $prefix.'_' . time() . '.' . $this->_fileExtension;
			$resuilt = copy($source,$dest);
			
			$sql_addColor = "Insert color(colorName,Img_color) values('$colorName','$name')";
			$success = mysql_query($sql_addColor);
	
			$colorID = mysql_insert_id();
			$sql_product ="select * from product";
			$re_pro = mysql_query($sql_product);
				while ($row = mysql_fetch_array($re_pro))
					{
					$proID = $row['proID'];
						if(!empty($proID))
						{
						$sql_procolor = "insert into procolor(proID,colorID,Img) values($proID,$colorID,'')"; 
						mysql_query($sql_procolor);
						}
					}
			
		}			
}
?>
