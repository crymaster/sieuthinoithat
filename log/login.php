<div>
<form action="index.php?go=loginprocess" method="post" name="form_login" id="form_login">
<table width="100%" border="0" height="250px" bgcolor="#FFFFFF" >
  <tr>
    <td align="center">
    	<table width="500px" border="0" align="center" cellpadding="1" cellspacing="3" height="150px">
          <tr>
            <td align="center" colspan="2" style="font-size:24px;font-weight:bold; color:#FF0000">Chào mừng bạn đến website CDS</td>
          </tr>
          <tr>
            <td align="right" style="font-size:16px"><i>Tên đăng nhập :</i></td>
           <td align="left"><input name="user" type="text" onblur="on_blur(this)" onclick="on_click(this)" value="Tên đăng nhập" size="30" /></td>
          </tr>
          <tr>
            <td align="right" style="font-size:16px"><i>Mật khẩu :</i></td>
           <td align="left"><input name="pass" type="password" onblur="on_blur_pass(this)" onclick="on_click_pass(this)" value="Mật khẩu" size="30"/></td>
          </tr>
          <tr>
            <td align="right"><input type="submit" value="Đăng nhập"/></td>
           <td align="left"><input name="Reset" type="reset" value="Làm lại"/></td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td style="font-size:16px"><em><strong>Bạn đã là thành viên của CDS chưa? </strong></em></td>
          </tr>
          <tr>
            <td style="font-size:14px"><a href="index.php?go=register">Đăng ký tài khoản</a> tại CDS để đặt mua và xem hàng một cách dễ dàng, nhanh chóng và trở thành khách hàng thân thiết của chúng tôi...</td>
          </tr>
        </table>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
  
</table>
</div>

	
</form>

<script>
	function on_click(t)
	{
		if(t.value=="Tên đăng nhập")
			t.value = "";		
	}
	
	function on_blur(t)
	{
		if(t.value=="")
			t.value = "Tên đăng nhập";		
	}
	function on_click_pass(t)
	{
		if(t.value=="Mật khẩu")
			t.value = "";		
	}
	function on_blur_pass(t)
	{
		if(t.value=="")
			t.value = "Mật khẩu";		
	}
</script>

