<?php
$action=$_REQUEST['action'];
if($action=='feed')
{
	if(session_is_registered('CusUser'))
	{ 
		$pid=$_REQUEST['pid'];
		$cusid=$_SESSION['cusID'];
	
		if(isset($_REQUEST['comtitle']))
		{
			$com_title=$_REQUEST['comtitle'];
			$com_content=$_REQUEST['comcontent'];
			$sql_comment="insert into feedback(proID,cID,feeTitel,feeContent,feeDate) values 	
				($pid,$cusid,'$com_title','$com_content',NOW())";
		if(mysql_query($sql_comment,$connect))
		{
			echo("<script> alert('Gửi ý kiến thành công  !');</script>");
		
		}
	}
}
	else  {  echo("<script> alert('Bạn cần đăng nhập để bình luận cho sản phẩm này');</script>");}

}



?>
<script>
	function checkComment()
	{
		<?php
			if(!isset( $_SESSION['CusUser'])){
		?>
		alert('Bạn cần đăng nhập để bình luận cho sản phẩm này');
		return false
		<?php
		}
		?>
		var obj1=document.getElementById('comtitle');
		var obj2=document.getElementById('comcontent');
		if(obj1.value=="")
		{
			alert('Tiêu đề của bạn không được để trống !');
			obj1.focus();
			return false;
		}
		if(obj2.value=="")
		{
			alert('Nội dung ý kiến dung của bạn không được để trống !');
			obj2.focus();
			return false;
		}
		return true;
	}
</script>
<form id="frm" name="frm" method="post" action="" onsubmit="return checkComment();" >
	<table class="borderAllTable" width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
	<td></td>
	</tr>
	<tr>
	<td height="50" align="left" valign="top">
	<div class="xinchao">
	<p>Bạn cần đăng nhập để đánh giá cho sản phẩm này,nếu chưa có hãy đăng ký là thành viên của Webside. Xin lưu ý:</p><p>
	- Các comment chỉ nói về sản phẩm và tính năng sản phẩm.</p><p>
	- Ngôn từ lịch sự. Tôn trọng cộng đồng, tôn trọng chính bản thân người comment</p>
	<p>
	- Mọi comment không hợp lệ, không hợp lý đều bị xóa.<hr class="hr" />
	</div>	</td>
	</tr>
	<tr>
	<td align="left" valign="top"><em>Tiêu đề      </em></td>
	</tr>
	<tr>
	<td align="left" valign="top"><input class="boder_text" name="comtitle" type="text" id="comtitle" size="50" maxlength="30" /></td>
	</tr>
	<tr>
	<td align="left" valign="top"><em>Nội dung</em> </td>
	</tr>
	<tr>
	<td align="left" valign="top"><textarea name="comcontent" class="boder_text" cols="55" rows="8" id="comcontent"></textarea>
	</td>
	</tr>
	<tr>
	<td align="center"><input type="submit" name="Submit" value="Gửi bình luận">
	<input name="Reset" type="reset" id="Reset" value="Xóa trắng" />
	<label>
	<input type="button" name="Submit2" value="Đóng lại" onclick="nonShow('feed');" />
	</label></td>
	</tr>
	</table>
</form>