<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="300" align="left" valign="top" bgcolor="#FFFFFF">
<?php
 if($_SESSION["CusUser"]==""){
	Redirect('index.php?go=shoppingcart_login');
	}
?>
<script>
	function checkOrderShip1()
	{
		var b1=document.getElementById('OrdName');
		var b2=document.getElementById('OrdAdd');
		var b3=document.getElementById('OrdPhone');
		var reg_b1=/^[a-zA-Z ]+$/;
		var reg_b3=/^[0-9]{7,11}$/;
		var reg_b2=/^[0-9a-zA-Z-]+[ a-zA-Z0-9-]*$/;
		if(b1.value=='')
		{
			alert('Bạn phải nhập giá trị cho người nhận');
			b1.focus();
			return false;
		}
		else if(!reg_b1.test(b1.value))
		{
			alert('Bạn nhập tên người nhận chưa đúng');
			b1.focus();
			return false;
		}
		else if(b2.vale=='')
		{
			alert('Bạn phải nhập địa chỉ người nhận');
			b2.focus();
			return false;
		}
		else if(!reg_b2.test(b2.value))
		{
			alert('Bạn nhập địa chỉ người nhận không đúng');
			b2.focus();
			return false;
		}
		else if(b3.value=='')
		{
			alert('Bạn phải nhập số điện thoại');
			b3.focus();
			return false;
		}
		else if(!reg_b3.test(b3.value) || eval(b3.value)<=0)
		{
			alert('Bạn nhập số điện thoại chưa đúng');
			b3.focus();
			return false;
		}
		else
		{
			
		}
	}

</script>
<form name="frmsendcart" method="post" action="index.php?go=shoppingcart_send2" onSubmit="return checkOrderShip1();">
<?php
	//read information customer
	$sql="Select * from customers where cUser='".$_SESSION["CusUser"]."'";
	$res=mysql_query($sql,$connect);
	$row=mysql_fetch_array($res);
	 $_SESSION["cusID"]=$row['cID'];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>


<fieldset class="borderAllTable">
<legend>Thông tin khách hàng </legend>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td width="30%" align="right">Họ tên: </td>
<td width="621" align="left"><?php echo($row['cName'])?></td>
</tr>
<tr>
<td align="right">Địa chỉ </td>
<td align="left"><?php echo($row['cAddress'])?></td>
</tr>
<tr>
<td align="right">Số diện thoại </td>
<td align="left"><?php  echo($row['cPhone'])?></td>
</tr>
<tr>
<td align="right">Email: </td>
<td align="left"><?php  echo($row['cEmail'])?></td>
</tr>
</table>
</fieldset>
<fieldset class="borderAllTable">
<legend>&nbsp;Ngày giao hàng và hình thức thanh toán </legend>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td width="50%" align="right">Ngày giao hàng
<input class="input" name="OrdShipDate" type="text" size="20" onKeyPress="popUpCalendar(this, document.forms.frmsendcart.OrdShipDate, 'dd-mm-yyyy', 0)" id="OrdShipDate" style="color:#990000">
<img src="media/calendar.png" onclick="popUpCalendar(this, document.forms.frmsendcart.OrdShipDate, 'yyyy-mm-dd', -100)"/>		</td>
<?php
	//read information payment
	$sql="Select * from paymentmethod ";
	$res=mysql_query($sql,$connect);	
	?>
	<td align="left"><?php  while($row1=mysql_fetch_array($res)){?>
	<input name="PayID" type="radio" value="<?php  echo($row1['payID'])?>" checked="checked">
	<?php  echo($row1['payType'])?>
<?php }?>	 </td>
</tr>
</table>
</fieldset>
<fieldset class="borderAllTable">
<legend>Thông tin người nhận </legend>

<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td width="30%" height="35" align="right">Name:</td>
<td align="left"><input class="input" name="OrdName" type="text" id="OrdName" size="50" value="<?php echo($row['cName']) ?>"></td>
</tr>
<tr>
<td align="right">Address:</td>
<td align="left"><input class="input" name="OrdAdd" type="text" id="OrdAdd" size="50" value="<?php echo($row['cAddress']) ?>"></td>
</tr>
<tr>
<td align="right">Phone:</td>
<td align="left"><input class="input" name="OrdPhone" type="text" id="OrdPhone" size="50" value="<?php echo($row['cPhone']) ?>"></td>
</tr>
</table>

</fieldset>
&nbsp;</td>
</tr>
</table>

<p align="center">
<input type="button" name="back" value="Quay lại" onClick="history.back();">
<input type="submit" name="send" value="Gửi đơn hàng">
</p>
</form>


</td>
<td width="10">&nbsp;</td>

<td width="159" align="center" valign="top">
<?php require("include/menu_news.php");?><br />
<?php require("include/menu_support.php");?></td>
</tr>
</table>


