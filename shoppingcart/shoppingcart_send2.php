<?php
if($_SESSION["CusUser"]==""){
Redirect('index.php?go=shoppingcart_login');
}

	$date=$_REQUEST['OrdShipDate'];	
	//echo $date;
	$nowday=date("Y-m-d");
	//echo $nowday;
	if (strtotime($nowday) > strtotime($date)) {
         ?>
		 <script> 
		 	alert('Ngày tháng năm bạn chọn không đúng.Bạn phải chọn thời gian bắt đầu từ ngày hôm nay !');
		 </script>
		 <?php
		 Redirect('index.php?go=shoppingcart_send1');
    }else{

	$cart = $_SESSION["CART"];	
	//echo $cart;
	if($cart){
	//request value in form
	$OrdShipDate=$_REQUEST['OrdShipDate'];
	//echo $OrdShipDate; 
	$OrdName=$_REQUEST['OrdName'];
	$OrdAdd=$_REQUEST['OrdAdd'];
	$OrdPhone=$_REQUEST['OrdPhone'];
	$PayID=$_REQUEST['PayID'];
	$CusID = $_SESSION["cusID"];
	//Create new order insert vao bang orders
	if($OrdShipDate=="")
	{
		$sql1 = "INSERT INTO orders(oDateCreate,oShipDate,ordName, ordAdd,ordPhone,status,payID,cID) VALUES(Date(Now()),Date(Now()),'$OrdName','$OrdAdd','$OrdPhone',1,$PayID,$CusID)";
	}
	else
	{
		$sql1 = "INSERT INTO orders(oDateCreate,oShipDate,ordName, ordAdd,ordPhone,status,payID,cID) VALUES(Date(Now()),'$OrdShipDate','$OrdName','$OrdAdd','$OrdPhone',1,$PayID,$CusID)";
	}
	
	//echo $sql1;
	mysql_query($sql1,$connect);
				
	//Select Max(OrdID)		
	$sql = "SELECT oID FROM orders ORDER BY oID DESC LIMIT 0,1";
	$res = mysql_query($sql,$connect);
	while($row = mysql_fetch_array($res))
	{
		$OrdID = $row['oID'];
	}
	//Insert into Order Detail
	foreach(array_keys($cart) as $value)
	{
		//Select ProPrice 
		$sql = "SELECT * FROM product WHERE proID = ".$value;
		$res = mysql_query($sql,$connect);
		while($row = mysql_fetch_array($res))
		{
			$ProPrice = $row["priceSale"];
		}

		//Insert into order detail
		$sql = "INSERT INTO orderdetail(oID,proID,quantity,ordPrice) VALUES($OrdID,$value,".GetQuantity($value).",$ProPrice)";
		//echo $sql;
		mysql_query($sql,$connect);
	}
	$key = array_keys($cart);
	for ($i=0; $i < count($key)-1; $i++) { 
		for ($j=$i + 1; $j < count($key); $j++) { 
			$sql = "SELECT COUNT(1) 
					FROM product_relation 
					WHERE (proId1 = $key[$i] AND proId2 = $key[$j])
					OR	  (proId1 = $key[$j] AND proId2 = $key[$i])";
			$query = mysql_query($sql,$connect);
			$count = mysql_fetch_array($query);
			if ($count[0] == 0) {
				$sql = "INSERT INTO product_relation
						(proId1, proId2, color_point, category_point, related_point, total_point)
						VALUE
						($key[$i], $key[$j], 0, 0, 2, 0)";
				mysql_query($sql,$connect);
			} else {
				$sql = "UPDATE product_relation
						SET related_point = related_point + 1
						WHERE (proId1 = $key[$i] AND proId2 = $key[$j])
						OR	  (proId1 = $key[$j] AND proId2 = $key[$i])";
				mysql_query($sql,$connect);
			}
		}
	}
	//Xoa shopping cart
	$_SESSION["CART"] = "";
	Redirect('index.php?go=shoppingcart_send3');					
}
}
?>