<style type="text/css">

ol.tab {
background: url(media/dot.gif) repeat-x left bottom;
list-style: none;
margin: 0;
padding: 6px 0;
position: relative;
}

ol.tab li {
background: #F2F5FA;
border: 1px solid #D3DDED;
display: inline;
margin-right: 5px;
padding: 0;
}

ol.tab li {
margin-right: 0px;
padding: 5px 10px;
cursor:pointer;
}

ol.tab li.active {
background: #FFF;
border-bottom: 1px solid #FFF;
font-weight: bold;
padding: 5px 10px;
}

/* Style for link tag */
ol.tab li {
font-weight: bold;
margin: 0;
padding: 5px 10px;
}

#content {
border-top: none;
padding: 2px;
}
</style>
<?php
	$action=$_REQUEST['action'];
	$proid=$_REQUEST['pid'];
	$cateID=$_REQUEST['cateID'];
	$gpCateID=$_REQUEST['gpCateID'];
	//$sql="select * from product where proID=".$proid;
	$sql = "SELECT     *
	FROM         supplier INNER JOIN
	product ON supplier.subID = product.subID where product.status=1 and product.proID=".$proid;
	$result = mysql_query($sql,$connect);
	$save = mysql_fetch_array($result);
?>
<script type="text/javascript" language="javascript">
var curPos=0;
var cur = 0;
function Slide(index)
{
	document.getElementById("img"+curPos).style.display="none";
	document.getElementById("img"+index).style.display="";
	curPos = index;
}
function show(index)
{
	//document.getElementById("proimg"+cur).style.display="none";
	document.getElementById(index).style.display="";
	//cur = index;
}
function nonShow(index)
{
	document.getElementById(index).style.display="none";
}
</script>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
<tr>

<td valign="top" width="835">
	<table align="left" class="borderAllTable" width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td>
	<?php include "include_proDetail/product.php"?>
	</td>
	</tr>
	<tr>
	<td>

		<ol class="tab">
		<li class="active" onclick="Slide(0)">Giới thiệu</li>
		<li onclick="Slide(1)">Kỹ thuật</li>
		<li onclick="Slide(2)">Bình luận </li>
		<li onclick="Slide(3)">Sp cùng loại </li>
		</ol>
	<div id="content" style="width:835">
	<?php  include "include_proDetail/intro.php"?>
	<?php include "include_proDetail/spec.php"?>
	<?php include "include_proDetail/feedback.php"?>
	<?php include "include_proDetail/pro_mod.php"?>
	</div>
	</td>
	</tr>
	<tr>
	<td>
	<img src="media/Y-kien-cua-ban.gif" width="131" height="22" onclick="show('feed')"/>
	<div id="feed" style="display:none">
	<?php include 'comment.php'; ?>
	</div></td>
	</tr>
	<tr>
	<td>
	</tr>
	</table>
</td>

</tr>
</table>
