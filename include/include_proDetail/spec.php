<div id='img1' style='display:none'>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><table width="100%" class="borderAllTable" border="0" cellspacing="0" cellpadding="0">
<?php	
$sql = "SELECT    attribute.*, att_product.*
FROM      Product INNER JOIN
att_product ON product.proID = att_product.proID INNER JOIN
attribute ON att_product.attID = attribute.attID
where attribute.status=1
 and product.proID=".$proid;
$qr = mysql_query($sql);
while($row = mysql_fetch_array($qr))
{
$specName = $row['attName'];
$psContent = $row['att_value'];
?>
<?php	if($psContent!=''){
?>
<tr>
<td width="40%" align="right"><span class="font_spec">
<?php $specName?>
</span>:
<hr class="hr" /></td>
<td align="left">&nbsp;&nbsp;&nbsp;&nbsp; <span class="font_spec">
<?php $psContent?>
</span>
<hr class="hr" /></td>
</tr>
<?php } }?>
</table></td>
</tr>
</table>
</div>
