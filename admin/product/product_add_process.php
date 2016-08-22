<?php require_once 'Upload_images/upload.class.inheritance.php';?>
<?php
$action=$_REQUEST['action'];
 if($action=='add')
  {
		$proName=$_REQUEST['proName'];
		$cateID = $_REQUEST['modID']; // Lay ra dong san pham
		$supID=$_REQUEST['supplier'];
		$proImage = $_REQUEST['txtanh'];
		$proDescription=$_REQUEST['proDescription'];
		$proSalePrice = $_REQUEST['salePrice'];
		$proPrice=$_REQUEST['proPrice'];
		$proQuantity=$_REQUEST['proQuantity'];
		$proStatus=$_REQUEST['proStatus'];  
		//tạo câu lệnh
		if($proSalePrice=='')
		{
			$sql_addpro = "insert into product(proName,proDes,price,images,postTime,status,subID) 															values('$proName','$proDescription',$proPrice,'$proImage',NOW(),'$proStatus','$supID')";
		}
		else
		{
			$sql_addpro = "insert into product(proName,proDes,price,priceSale,images,postTime,status,subID) 															values('$proName','$proDescription',$proPrice,$proSalePrice,'$proImage',NOW(),'$proStatus','$supID')";
		}
	//echo $sql_addpro;
	//thực hiện câu lệnh
	$success = mysql_query($sql_addpro,$connect);
	$proID = mysql_insert_id();
	if($success) //nếu thêm product thành công
	{	
		$sql_spec = "select * from attribute"; //tạo câu lệnh và vòng lặp lấy lần lượt mã specID
		$re_spec = mysql_query($sql_spec,$connect);
		while($rown = mysql_fetch_array($re_spec))
		{	

		    $specID = $rown['attID'];
			$detail = $_REQUEST["txt".$specID];
					
			if($detail!='')
			{
					$sql_prospec = "INSERT INTO att_product(attID,proID,att_value) VALUES($specID,$proID,'$detail')";
					mysql_query($sql_prospec);//echo $sql_prospec;
					
					
			}
			else
			{
					$sql_prospec = "INSERT INTO att_product(attID,proID,att_value) VALUES($specID,$proID,'')";
					mysql_query($sql_prospec);//echo $sql_prospec;
			}
			
		}
		// Them vao bang product_catogory
		$sql_addProCate="insert into product_category(proID,cateID) values($proID,$cateID)";
		$sql_addProCateTest=mysql_query($sql_addProCate,$connect);
		if($sql_addProCateTest)
		{
			
		}
		
		$color = $_REQUEST["txt18"];
		$sql_product_relation = 
		"INSERT INTO product_relation
			(proId1, proId2, color_point, category_point, related_point, total_point)
		SELECT
			$proID
			,P.proId
			,IF(AP.attID IS NULL,0,1) AS colorId
			,IF(PC.cateID = $cateID, 0, 1)
			,1
			,0
		FROM product P
		LEFT JOIN product_category PC
			ON 	P.proID = PC.proID
		INNER JOIN att_product AP
			ON AP.proId = P.proID
			AND AP.att_value = '$color'";
		$result = mysql_query($sql_product_relation,$connect);
		echo("<script> alert('Thêm mới sản phẩm thành công !');</script>");
		echo("<script> window.location='admin.php?go=product_list'; </script>");

	}
	
	
	else
	{
		echo("<script> alert('Thêm mới sản phẩm thất bại !');</script>");
		echo("<script> window.location='admin.php?go=product_add_new'; </script>");
		
		
	}
}
?>
