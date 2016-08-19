<?php
class Upload
{
	//bien luu ten file upload
	var $_fileName;
	
	//bien luu tru kich thuoc file upload
	var $_fileSize;
	
	//bien luu tru phan mo rong(kieu file[ex:gif/jpg/png])
	var $_fileExtension;
	
	//luu tru duong dan cua tap tin upload
	var $_fileTmp;
	
	//luu tru duong dan thu muc up len server
	var $_uploadDir;

	//bien luu tru thong tin loi khi upload
	var $_errors;

	//phuong thuc khoi tao doi tuong
	function __construct($file_name)
	{
		//echo __METHOD__;
		$fileInfo = $_FILES[$file_name];
		$this->_fileName = $fileInfo['name'];
		$this->_fileSize = $fileInfo['size'];
		$this->_fileExtension = $this->getFileExtension();
		$this->_fileTmp = $fileInfo['tmp_name'];
/*		echo "Thong tin cua anh:";
		echo "<pre>";
		print_r($fileInfo);
		echo "<pre>";*/
	
	} 
	
	//phuong thuc lay thanh phan mo rong cua tap tin upload
	//su dung pattern de lay phan mo rong: jpg/gif/png...
	function getFileExtension()
	{
		$subjiect = $this->_fileName;
		$patterns = '#\.([^\.]+)$#i'; 
		
		preg_match($patterns,$subjiect,$matches);
		
/*		echo "Thong tin phan mo rong cua Tap tin :"."<pre>";
		print_r($matches);
		echo "<pre>";*/
		
		return $matches[1];
	}
	
	//phuong thuc thiet lap thanh phan mo rong cua tap tin duoc phep upload
	//Ham check kieu file
	//$value string: ex:gif,jpg
	function checkFileType($value)
	{
		$subject = $this->_fileExtension;
		$pattern = '#('.$value.')#i';
		if(preg_match($pattern,$subject)!=1)
			$this->_errors[] = 'Phan mo rong khong phu hop';
	}
	
	//phuong thuc thiet lap kich thuoc file lon nhat dc phep upload
	//Ham check kich thuoc file
	function checkFileSize($value)
	{
		$size = $value * 1024;
		if($this->_fileSize > $size )
			{
				$this->_errors[] = 'Kich thuoc khong phu hop';
			}
		
	} 
	
	//phuong thuc thiet lap thu muc upload
	//param string(ex:image/)
	function setUploadDir($value)
	{
		if(file_exists($value))
		{
			$this->_uploadDir = $value; 
		}
		else
		{
			$this->_errors[] = 'Thu kuc khong ton tai';
		}
	} 
	
	//phuong thuc kiem tra dieu kien upload 
	function isVail()
	{
		$flag = false;
		if(count($this->_errors) > 0)
			$flag = true;
		return 	$flag;
	}
	
	//phuong thuc upload tap tin
	function upload_image()
	{
			$prefix=rand(1,100);
	
			$source = $this->_fileTmp;
			$dest = $this->_uploadDir . $prefix.'_' . time() . '.' . $this->_fileExtension;
		
/*		$sql="INSERT INTO ".$table."
		VALUES ('',1,'".$dest."','".$comment."','imgColor',1)";
		mysql_query($sql);*/
		$resuilt = copy($source,$dest);
	}

}
?>
