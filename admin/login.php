<?php session_start(); ?>
<?php
	require('connect.php');
	if($_REQUEST["login"]==true)
	{
	$useradmin=$_REQUEST['useradmin'];
	$passadmin=$_REQUEST['passadmin'];
	$sql = "SELECT * FROM admin_use where accname='".$useradmin."' and pass='".$passadmin."'";
	//echo($sql);
	
	$re=mysql_query($sql,$connect);
	$row = mysql_fetch_array($re);
	//die();
  	if(mysql_num_rows($re)>=1)
	{
		$_SESSION["useradmin"]=$useradmin;
		$_SESSION["admName"]=$row['accName'];
		//echo($_SESSION["useradmin"]);
		//die();
		Redirect('admin.php');		
	}
	
		Redirect('login.php?err=loi');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đăng nhập hệ thống quản trị</title>

<link rel="stylesheet" href="style/style.css" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: 36px;
	color: #CCCCCC;
	font-weight: bold;
	font-style: italic;
}
.style5 {font-size: 16px}
.style6 {color: #CCCCCC}
-->
</style>
</head>
<script language="javascript">
	function checklogin(){
		if(frmlogin.useradmin.value==""){
			alert("Bạn chưa nhập tên");
			frmlogin.useradmin.focus();
			frmlogin.useradmin.select();
			return false;
		}
		if(frmlogin.passadmin.value==""){
			alert("Bạn chưa nhập mật khẩu");
			frmlogin.passadmin.focus();
			frmlogin.passadmin.select();
			return false;
		}
	}
</script>
<body bgcolor="#000000">
<form id="frmlogin" name="frmlogin" method="post" action="login.php?login=true">
  <table  bgcolor="#333333" width="95%" height="700" align="center" cellpadding="5" cellspacing="5" >
    <tr>
      <td><table width="57%" align="center">
        <tr>
          <td colspan="2" align="center" > <span class="style1">HỆ THỐNG QUẢN TRỊ </span></td>
          </tr>
        <tr>
          <td width="40%" align="right"><span class="xinchao style5 style6"><em><strong>Tên đăng nhập</strong></em></span></td>
          <td width="60%" align="left"><label>
            <input name="useradmin" type="text" id="useradmin" size="35" />
          </label></td>
        </tr>
        <tr>
          <td align="right"><span class="style6 xinchao style5"><em><strong>Mật khẩu</strong></em></span></td>
          <td align="left"><input name="passadmin" type="password" id="passadmin" size="35" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="left"><label>
            <input type="submit" class="button" name="button" id="button" value="Đăng nhập" onclick="return checklogin();" />
            <input type="reset" class="button"name="button2" id="button2" value=" Nhập lại " />
          </label></td>
        </tr>
        <tr>
				  <td height="27" colspan="2" align="center"><span class="xinchao">
				  
				  <?php
				  	if($_REQUEST['err']!='')
						echo('Tài khoản hoặc mật khẩu không đúng!');
				  ?>
				  </span>
				  
		</tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
