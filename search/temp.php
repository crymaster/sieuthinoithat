<?php
		$_SESSION['price']=$_REQUEST['price'];
		$_SESSION['category']=$_REQUEST['category'];
		$_SESSION['supplier']=$_REQUEST['supplier'];
		$_SESSION['group_category']=$_REQUEST['group_category'];
		
?>

<script> window.location='index.php?go=searchadvanced&act=search&page=1';</script>