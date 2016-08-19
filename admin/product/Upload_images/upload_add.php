<?php
$action=$_REQUEST['action']; // request action tu link cua prodetail.php hoac product_edit.php
$proID=$_REQUEST['proID'];  // request proID tu link cua prodetail.php hoac product_edit.php
?>
<style type="text/css">
.text
{
border:1px #3399FF  dashed;
border-left:none;
border-right:none;
border-top:none;
font-family:Arial, Helvetica, sans-serif;
color: #666666;
font-style:italic;
}
.table
{
border:1px  #3399FF solid;

}
</style>


<title>Upload Image on DB</title><form action="admin.php?go=upload_img_add&proID=<?php echo $proID?>" method="post">
<div align="center">
  <em><strong>Enter your Image:</strong></em> 
  <input type="text" name="txtnum" id="txt" value="<?php echo $_POST['txtnum']; ?>" size="2"  disabled="disabled"/>
<select name="txtnum">
<script language="javascript">
	for(i=1;i<10;i++)
	{
	  	for(i=1 ; i<=30; i++)
		{
			document.write('<option value="' + i + '">' + i + '</option>');
		}
	}
</script>  
</select>

<input type="submit" name="ok_num" value="Accept" />
</div>
</form>


<?php
if(isset($_POST['ok_num']))
{
	$num=$_POST['txtnum'];
	echo "<hr  class='table'/>";
?>	
	<form action='admin.php?go=process_upload_imgAdd&action=process_upload_imgAdd&num=<?php echo $num?>&proID=<?php echo $proID?>' method='post' enctype='multipart/form-data'>
     		<table class="table" width="600" border="0" align="center">
      <tr>
        <td>
	  <?php
	for($i=1; $i <= $num; $i++)
	{
	?>
	

		
			<table width="100%" border="0" align="center" >
          <tr>
            <td width="23%" align="right"><em><strong>Image <?php echo $i ?> :</strong></em></td>
            <td width="77%"><input type='file' name='img<?php echo $i?>' id="img<?php echo $i?>" /><span  style="color:#FF0000; font-size:12px; font-style:italic"id="span<?php echo $i?>"></span></td>
          </tr>
		            <tr>
            <td width="23%" align="right"><em><strong>Title:</strong></em></td>
            <td><label>
              <input type="text" name="title<?php echo $i?>" class="text" />
            </label></td>
          </tr>
          <tr>
            <td align="right"><em><strong>Comment</strong></em><em><strong>:</strong></em></td>
            <td><input name='text<?php echo $i?>' type='text' class="text" size="50" width="70" />
			</td>
          </tr>
        </table>
		<hr class="table" />
		<?php }?>	
		</td>
      </tr>
      <tr>
        <td align="center"><input type='submit' name='ok_upload' value='Upload' /></td>
      </tr>
    </table>
	

	</form>
<?php	
}
?>
