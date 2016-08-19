<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="lavender">
<center>
<?php
	$Thumuc = $_REQUEST["Thumuc"];
	$form = $_REQUEST["form"];
	$input = $_REQUEST["input"];
	$anh = $_REQUEST["anh"];
	
	$d = $_FILES["f11"]["type"];
	$a = $_FILES["f11"]["tmp_name"];
	if ($_REQUEST["cmd"] =="Upload"){
		
		if (substr($d,0,5)=="image"){
		move_uploaded_file($a,$Thumuc."/".$_FILES["f11"]["name"]);
		echo "Upload thanh cong file <b>{$tenfile}</b>!";
		$error=1;
		} else {
		echo "Upload khong thanh cong!";
		$error=0;
		}
	} else {
?>

<form enctype="multipart/form-data" method="post">
 <div align="center">
   <h1>Upload file 
   </h1>
 </div>
 <table width="400" border="0" align="center" cellpadding="3" cellspacing="3">
    <tr>
      <td>Chon file anh : </td>
      <td><input name="f11" type="file" id="f11"></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input name="cmd" type="submit" id="cmd" value="Upload">
      <input type="reset" name="Reset" value="Reset"></td>
    </tr>
  </table>
</form>
<?php } ?>
<input type="button" value="Close Window" onClick="window.opener.document.<?php echo $form?>.<?php echo $input?>.value='<?php  if ($error==1) echo $_FILES["f11"]["name"];?>'; 
window.opener.document.<?php echo $anh?>.src='<?php  if ($error==1) echo $Thumuc.'/'.$_FILES["f11"]["name"];?>';
window.close();">
</body>
</html>
