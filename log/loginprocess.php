<?php
$loi='';
if(isset($_REQUEST['user']))
{
   $cusUser = $_REQUEST['user'];
   $cusPass= $_REQUEST['pass'];
   //$mahoalog = md5($cusPass);
   $mahoalog = $cusPass;
   $sql="select * from customers where cUser ='".$cusUser."' and status = 1";
   $re_cus=mysql_query($sql,$connect);
   $num_row=mysql_num_rows($re_cus);
   if($num_row!=0)
   {
     while($row = mysql_fetch_array($re_cus))
	 {
	    if($mahoalog == $row['cPassWord'])
		{
	
		   //session_register('CusEmail');
		   $_SESSION['CusUser'] = $row['cUser'];
		   $_SESSION['CusEmail']= $row['cEmail'];
		   $_SESSION['Name'] = $row['cName'];
		   $_SESSION['cusID'] =$row['cID'];
		   $_SESSION['cuspass'] =$row['cPassWord'];
		  // echo " <script> alert('". $_SESSION['CusUser']."'); </script>";
		   ?>
		  
		   <?php
		   redirect("index.php");
		 // echo("<script>window.location='index.php?go=home';</script>");
		}
		else
		{
			
			echo("<script>window.location='index.php?go=errorlogin';</script>");	
		
		}
	 }
   }
   else
   {
   	echo("<script>window.location='index.php?go=errorlogin';</script>");	
   
   }
  }
?>
