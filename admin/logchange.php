<?php
	$user=$_SESSION['useradmin'];
	$sql="select * from admin_use where accName='".$user."'";
	$result=mysql_query($sql,$connect);
	if($result)
	{
		$row=mysql_fetch_array($result);
		$act=$_REQUEST['act'];
		$newpass=$_REQUEST['newpass'];
		$cfpass=$_REQUEST['cfpass'];
		if($act=='change')
		{
			if($newpass=="")
			{
				echo "<script> alert('Password mới không được để trống'); </script>";
				echo "<script> window.location='admin.php?go=logchange' </script>";
			}
			elseif($newpass!=$cfpass)
			{
				echo "<script> alert('Password mới không hợp lệ'); </script>";
				echo "<script> window.location='admin.php?go=logchange' </script>";
			}
			else
			{
				$sql1="update admin_use set pass='".$newpass."' where accID=".$row['accID'];
				if(mysql_query($sql1,$connect))
				{
					echo "<script> alert('Bạn đã thay đổi password thành công'); </script>";
					echo "<script> window.location='http://localhost:8888/noithat/admin/login.php'; </script>";
				}
				else
				{
					echo "<script> alert('Bạn đã thay đổi password khong thành công'); </script>";
					echo "<script> window.location='admin.php?go=logchange' </script>";
				}
			}
		}
	}	
?>

<form action="admin.php?go=logchange&act=change" method="post" >
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
	<td height="50" colspan="2" align="center" background="../media/banner_l.jpg"><span class="style1">THAY ĐỔI THÔNG TIN ADMIN</span></td>
</tr>
<tr>
	<td class="row" width="42%" align="right" >Tên Admin</td>
	<td class="row" width="58%" align="left"><input name="name" id="name" type="text" value="<? echo($row['accName']);?>" size="35" disabled="disabled"></td>
</tr>
<tr>
	<td class="row" width="42%" align="right" >Mật khẩu Admin</td>
	<td class="row" width="58%" align="left"><input name="oldpass" id="oldnewpass" type="password" value="<? echo($row['pass']);?>" size="35"></td>
</tr>
<tr>
	<td class="row" width="42%" align="right" >Mật khẩu mới Admin</td>
	<td class="row" width="58%" align="left"><input name="newpass" id="newpass" type="password" value="" size="35"></td>
</tr>
<tr>
	<td class="row" width="42%" align="right" > Nhập lại mật khẩu mới Admin</td>
	<td class="row" width="58%" align="left"><input name="cfpass" id="cfpass" type="password" value="" size="35"></td>
</tr>	
	<td class="row" width="42%" align="right" ><input type="submit" name="submit" id="submit" value="Thay Đổi" /></td>
	<td class="row" width="42%" align="left" ><input type="reset" name="Reset" id="submit" value="Làm Lại" /></td>
</table>
</form>