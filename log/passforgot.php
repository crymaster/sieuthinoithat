<?php
if($_POST['ans']!='')
{
	$ans_query = "select answer from customers where cUser = '".$_GET['user']."'";
	$re_ans = mysql_query($ans_query);
	$row = mysql_fetch_array($re_ans);
	if($_POST['ans'] == $row['answer'])
	{
		$_SESSION['CusUser']=$_GET['user'];
		redirect("index.php?go=passchange");
	}
	else
	{
		echo "Câu trả lời không đúng. <a href='index.php?go=passforgot'>Trở lại</a>";
		
	}
}
else
{
	if($_POST['user']=='')
	{
?>
<form action="" method="post">
Tên đăng nhập<input type="text" name="user"/>
<input type="submit" value="Tiếp">
</form>
<?php
	}
	else
	{
		$user_query = "select cUser,question from customers join question
					on customers.quesID = question.quesID where cUser = '".$_POST['user']."'";
		$re_user = mysql_query($user_query);
		if(mysql_num_rows($re_user)>0)
		{
			$row = mysql_fetch_array($re_user);
?>
<form action="index.php?go=passforgot&user=<?php echo $_POST['user']?>" method="post">
	<h3>Trả lời câu hỏi bí mật</h3>
	<table width="475">
		<tr>
			<td width="109">Câu hỏi bí mật
			<td width="354"><?php echo $row['question'].'?'?>
		<tr>
			<td>Câu trả lời
			<td><input type="text" name="ans">
  </table>
  	<input type="submit" value="Tiếp">
</form>
<?php
		}
		else
		{
			$_POST['user']='';
			echo "Tên đăng nhập không tồn tại. Hãy kích vào <a href='index.php?go=passforgot'>đây</a> để trở lại";
		}
	}
}
?>
