<?php
	$connect = mysql_connect("localhost","root","");
	if(!$connect)
	{
		die("Could not connect: ". mysql_error());
	}else{
		mysql_select_db("sieuthinoithat",$connect);
		mysql_query("SET NAMES 'UTF8'",$connect);
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
			$quantity = $cart[$pid];
			break;
		}
	}
	return $quantity;
} 
?>
<?php
function Redirect($url)
{
?>
<script type="text/javascript">
window.location = "<?=$url?>";
</script>
<?php
}
?>
