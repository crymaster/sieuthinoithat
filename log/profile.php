<?php
	$query = "SELECT * FROM customers WHERE cUser='".$_SESSION['CusUser']."'";
	$re_all= mysql_query($query);
	$row = mysql_fetch_array($re_all);
?>
<h3 align="center">Hồ sơ cá nhân</h3>
<form name="form1" method="post" action="index.php?go=profile&action=save" onSubmit=" return checkProfile();" style="background-color:#FFFFFF">

  <table width="374" height="450" border="0" align="center">
    <tr>
      <td width="174">Tên đăng nhập</td>
      <td width="190"><?php echo $_SESSION['CusUser'];?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="email" type="text" id="email" value="<?php echo $row['cEmail'];?>"></td>
    </tr>
    <tr>
      <td>Mật khẩu cũ </td>
      <td><input name="opass" type="password" id="opass"></td>
    </tr>
    <tr>
      <td>Mật khẩu mới </td>
      <td><input name="npass" type="password" id="npass"></td>
    </tr>
    <tr>
      <td>Xác nhận mật khẩu mới </td>
      <td><input name="npass1" type="password" id="npass1"></td>
    </tr>
    <tr>
      <td>Họ và tên </td>
      <td><input name="name" type="text" id="name" value="<?php echo $row['cName'];?>"></td>
    </tr>
    <tr>
      <td>Giới tính</td>
      <td>
        <label>
          <input name="gender" type="radio" value="1" checked>
          Nam</label>
        
        <label>
          <input type="radio" name="gender" value="0">
          Nữ</label>
       
        <label>
          <input type="radio" name="gender" value="2">
          Khác</label>
     
     </td>
    </tr>
    <tr>
      <td>Địa chỉ</td>
      <td><input name="address" type="text" id="address" value="<?php echo $row['cAddress'];?>"></td>
    </tr>
    <tr>
      <td>Số điện thoại</td>
      <td><input name="phone" type="text" id="phone" value="<?php echo $row['cPhone'];?>"></td>
    </tr>
    <tr>
	  <?php
		$sql="select * from question ";
		$re= mysql_query($sql,$connect);
	  ?>
      <td>Câu hỏi bí mật </td>
      <td><select name="ques" id="ques">
	  <option value="0">Chọn một câu hỏi</option>
		<?php
			while($row=mysql_fetch_array($re))
			{
		?>
			<option value="<?php echo($row['quesID']);?>"><?php echo($row['question']);?></option>
		<?php
			}
		?>

      </select>
      </td>
    </tr>
    <tr>
      <td>Câu trả lời</td>
      <td><input name="answer" type="text" id="answer"></td>
    </tr>
    <tr>
      <td align="right"><input type="submit" name="Submit" value="Lưu lại" ></td>
      <td><input type="button" name="Submit2" value="Đóng lại" onClick="location='index.php'"></td>
    </tr>
  </table>

</form>
<?php
$action=$_REQUEST['action'];
if($action=='save')
{
	$query1 ="update customers set ";
	$query2 ="where cUser = '".$_SESSION['CusUser']."'";
	
	if($_REQUEST['email']!="")
	{
		$email = $_REQUEST['email'];
		$query = $query1."cEmail = '$email' ".$query2;
		
		mysql_query($query,$connect);
	}				
	if($_REQUEST['name']!="")
	{
		$name = $_REQUEST['name'];
		$query = $query1."cName = '$name' ".$query2;
		
		mysql_query($query,$connect);
	}	
	if($_REQUEST['address']!="")
	{
		$address = $_REQUEST['address'];
		$query = $query1."cAddress = '$address' ".$query2;
		
		mysql_query($query,$connect);
	}
	if($_REQUEST['phone']!="")
	{
		$phone = $_REQUEST['phone'];
		$query = $query1."cPhone = $phone ".$query2;
		echo $query;
		mysql_query($query,$connect);
	}	
	
	$gender = $_REQUEST['gender'];
	$query = $query1."gender = $gender ".$query2;
	mysql_query($query,$connect);
		
	if($_REQUEST['ques']!="0")
	{
		
		$ques = $_REQUEST['ques'];
		$query = $query1."quesID = $ques ".$query2;
		
		mysql_query($query,$connect);
	}	
	if($_REQUEST['answer']!="")
	{
		$answer = $_REQUEST['answer'];
		$query = $query1."answer = '$answer' ".$query2;
		
		mysql_query($query,$connect);
	}	
	$query = "select cPassWord from customers where cUser = '".$_SESSION['CusUser']."'";
	
	$result = mysql_query($query,$connect);
	$row = mysql_fetch_array($result);
	if($_REQUEST['opass']== $row['cPassWord'])
	{
		$pass = $_REQUEST['npass'];
		$query = $query1."cPassWord = $pass ".$query2;
		mysql_query($query,$connect);
	}
}
?>
