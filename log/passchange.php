<?php
	if($_SESSION['CusUser']!="")
	{
		if($_GET['action']=="ok")
		{
			$pass_query = "UPDATE customers SET cPassWord='".$_POST['pass']."' WHERE cUser = '".$_SESSION['CusUser']."'";
			if(mysql_query($pass_query))
			{
				echo "Bạn đã đổi mật khẩu thành công. Bấm vào <a href='index.php'>đây</a> để quay lại trang chủ";
			}
			else
			{
				echo "Đã có lỗi xảy ra trong quá trình đổi mật khẩu. Hãy thử lại sau ít phút";
			}
		}
		else
		{
?>
<form action="index.php?go=passchange&action=ok" method="post" onsubmit="return checkPass('pass','pass1');">
	<h3>Đổi mật khẩu</h3>
	<table>
		<tr>
			<td>Mật khẩu
			<td><input type="password" name="pass" id="pass">
		<tr>
			<td>Xác nhận mật khẩu
			<td><input type="password" name="pass1" id="pass1">
	  	  </table>
	<input type="submit" value="Đồng ý">
	<input type="button" value="Hủy" onClick="window.location='index.php'">
</form>
<?php
		}
	}
	else
		redirect("index.php");
?>
