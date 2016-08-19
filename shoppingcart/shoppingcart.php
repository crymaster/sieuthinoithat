<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="300" align="left" valign="top" bgcolor="#FFFFFF">
		<!------------------------->
		<?php
		require('cart.php');
		?>
		<script>
		var a = true;
		function IsNumeric(txt)
		{
			sText = txt.value;
			var IsNumber=true;
			var s1=String(sText);
			var a = true;
			var re=/\d /;
			if(s1=='')
			{
				alert('Chưa nhập số lượng !');
				txt.focus();
				IsNumber=false;
				a=false;
			}
			else
			if(isNaN(s1))
			{
				alert('Số lượng đặt phải là số !');
				txt.focus();
				IsNumber=false;
				a=false;
			}else
			if(re.test(s1))
			{
				alert('Số lượng đặt phải là số !');
				txt.focus();
				IsNumber=false;
				a=false;
			}else
			{
			
				s2=parseInt(s1);
				if(s2<=0 || s2!=eval(s1))
				{
					alert('Số lượng đặt phải là số nguyên dương !');
					txt.value=s2;
					IsNumber=false;
					a=false;			
				}
			}
			a=IsNumber;	
			return IsNumber;
		}
		function testform()
		{
			if(a){
				return true;
				}
			else
			{
				alert('Kiểm tra lại ! ');
				return false;
			}
		}
		function ShoppingCartSend()
		{
			if(a){
				document.location='index.php?go=shoppingcart_send1';
				return true;
			}
			else
			{
				alert('Kiem tra lai');
				return false;
			}
		}
		function muaTiep()
		{
			window.history.go(-1);
		}
		</script>
		<br />
		<br />
		<form action="index.php?go=shoppingcart" method="post" name="frmcart" id="frmcart" onsubmit="return testform();">
		<input type="hidden" id="action" name="action" value="update" />
		<h2> CÁC SẢN PHẨM TRONG GIỎ HÀNG</h2>
		<table width="100%" class="borderAllTable"  border="0" cellspacing="3" cellpadding="3">
		<tr class="carttitle">
		<th >STT.</th>
		<th align="center" >Ảnh</th>
		<th align="left" >Tên sản phẩm </th>
		<th align="left" >Số lượng </th>
		<th align="left" >Giá</th>
		<th align="left" >Thành tiền </th>
		<th align="left" >Thao tác </th>
		</tr>
		<?php
		$_SESSION['Count']=0;
		if($cart)
		{
			$idlist = "";
			$total=0;
			foreach(array_keys($cart) as $value)
			{
				$idlist = $idlist.$value.",";
			}
			$idlist = $idlist."0";
			$sql = "SELECT * FROM product WHERE proID IN (".$idlist.")";
			$rscart = mysql_query($sql,$connect);
			$stt=0;
		while($row = mysql_fetch_array($rscart))
		{
		$stt++;
		?>
		<tr>
		<td align="center" valign="middle"><?php echo($stt);?></td>
		<td align="center">&nbsp;
		<img src="image/<?php
		echo($row['images'])
		?>" width="50" height="50"/>  	  </td>
		<td align="left">
		<?php
		echo($row['proName'])
		?>	  </td>
		<td align="left">
		<input class="boder_text" name="Qty_<?php echo $row["proID"]?>" type="text" id="Qty_<?php echo $row["proID"]?>" value="<?php echo GetQuantity($row["proID"])?>" size="2" maxlength="1" onChange="return IsNumeric(this)"/></td>
		<td align="left">
		<?php
		echo(number_format($row['priceSale']))
		?> VND </td>
		<td align="left">
		<?php
		echo(number_format($row['priceSale']*GetQuantity($row['proID'])));
		$_SESSION['Count']=$_SESSION['Count']+ GetQuantity($row["proID"]);
		$total +=$row['priceSale']*GetQuantity($row['proID']);
		?> VND </td>
		<td align="center">
		<a href="index.php?go=shoppingcart&action=del&pid=<?php echo($row['proID'])?>" 
		onClick="if(confirm('Xác nhận xóa')) return true;else return false;">Xóa</a></td>
		</tr>
		
		<?php
		}
		?>
		<tr>
		<td colspan="5" align="right">Tổng:</td>
		<td colspan="2" align="left"><span class="style3"><?php echo(number_format($total))?> VND </span></td>
		</tr>
		<tr height="30" valign="middle" align="center">
		<td align="center" colspan="7">
		<hr class="hr"></td>
		</tr>
		
		<tr height="30" valign="middle" align="center">
		<td align="center" colspan="7">
		<input type="button" name="Continue" value="Mua hàng tiếp" onclick="muaTiep();">
		<input type="submit" name="update" value="Cập nhật">
		<input type="button" name="delete" value="Xóa tất cả" 
		onClick="if(confirm('Xac nhan xoa')) {location.href='index.php?go=shoppingcart&action=delall';}else return false;">
		<input type="button" name="shoppingcartsend" value="Đặt hàng" onClick="ShoppingCartSend();"></td>
		</tr>
		
		<?php
		}else{
		?>
		<tr height="30" valign="middle" align="left">
		<td align="left" colspan="7">
		Chưa có sản phẩm trong giỏ hàng...</td>
		</tr>
		<tr height="30" valign="middle" align="center">
		<td align="center" colspan="7">
		<input type="button" name="Continue" value="Mua hàng" onClick="muaTiep();"></td>
		</tr>
		
		<?php
		}
		?>
		</table>
	</form>		
	<!-------------------------->
	</td>
<td width="10">&nbsp;</td>

<td width="10">&nbsp;</td>
<td width="159" align="center" valign="top">

<?php require("include/menu_news.php");?><br />
<?php require("include/menu_support.php");?>

</td>
</tr>
</table>
