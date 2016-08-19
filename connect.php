<?php
	session_start();
    $connect = mysql_connect("localhost","root","");
	if(!$connect){
		die("Could not connect: ". mysql_error());
	}else{
		mysql_select_db("sieuthinoithat",$connect);
		mysql_query("SET NAMES 'UTF8'",$connect);
	}	
	
	//define('BASE_PATH','http://localhost:8888/sieuthisach/');
	function redirect($url){
		echo('<script type="text/javascript">location.href = "'. $url . '";</script>');
		}
?>

<?php
function GetQuantity($pid)
{
	$cart = $_SESSION["CART"];
	$quantity=0;
	foreach(array_keys($cart) as $value)
	{
		if($value == $pid)
		{
			$quantity =$quantity + $cart[$pid];
			break;
		}
	}
	return $quantity;
} 
?>
