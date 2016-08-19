<?
$sql_adm="select * from admin_use where status = 1 ";
$re_adm= mysql_query($sql_adm,$connect);
?>
<div id="while_line" style="background:#fff;height:2px;width:185px;">
</div>
<div id="support">
        <div id="titel_sitebar">
        	<p class="titel_info">Tư vấn Khách Hàng</p>
        </div><!--End #titel_sitebar-->
        
     
         <form name="form1" method="post" action="">
	<?
    while($row_adm=mysql_fetch_array($re_adm))
    {
    ?>
    <div class="line_sitebar">
    </div>
	<ul class="menuperson">
        <li> <a href="ymsgr:sendim?<? echo($row_adm['accEmail']);?>">
            <div id="person">
            	<div id="img_sup">
                	<img src="http://opi.yahoo.com/online?u=<? echo($row_adm['accEmail']);?>&m=g&t=2" border=0>
                </div>
                <div id="accName" style="color:red;">
                	Mr.<? echo($row_adm['accName']);?>
                </div>
                <div id="Phone">
                	<span style="color:#fff;">Phone:<? echo($row_adm['accPhone']);?></span>
                </div>
            </div>
   		 </a> 
        </li>
    </ul>
    
    <? }?>
    </form>
</div><!--End #support-->