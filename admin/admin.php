<?php session_start(); ?>

<?php
	require('connect.php');
?>
<?php
	$u=$_SESSION["useradmin"];
	//echo($u);
	//die();
	if($_SESSION['useradmin']=='')
	{
		Redirect('login.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src="javascript/checkData.js"></script>
<script language="javascript">

// JavaScript Document<!--
function mmLoadMenus() {
  if (window.mm_menu_0131215634_0) return;
  window.mm_menu_0131215634_0 = new Menu("root",150,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,false,false);
  mm_menu_0131215634_0.addMenuItem("Danh&nbsp;sách&nbsp;sản&nbsp;phẩm","location='admin.php?go=product_list&page=1'");
  mm_menu_0131215634_0.addMenuItem("Thêm&nbsp;mới&nbsp;sản&nbsp;phẩm","location='admin.php?go=product_add_new'");
  // mm_menu_0131215634_0.addMenuItem("Màu&nbsp;Sắc","location='admin.php?go=procolor'");
  // mm_menu_0131215634_0.addMenuItem("Thêm Màu&nbsp;Sắc","location='admin.php?go=procolor_add'");
   mm_menu_0131215634_0.addMenuItem("Thêm&nbsp;thông&nbsp;số&nbsp;kỹ&nbsp;thuật","location='admin.php?go=spec_add&page=1'");
  mm_menu_0131215634_0.addMenuItem("Danh&nbsp;sách&nbsp;thông&nbsp;số","location='admin.php?go=spec_list&page=1'");
  mm_menu_0131215634_0.addMenuItem("Tìm&nbsp;kiếm&nbsp;sản&nbsp;phẩm","location='admin.php?go=search&page=1'");
   mm_menu_0131215634_0.hideOnMouseOut=true;
   mm_menu_0131215634_0.bgColor='#FDFBFA';
   mm_menu_0131215634_0.menuBorder=1;
   mm_menu_0131215634_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0131215634_0.menuBorderBgColor='#FFFFFF';

  window.mm_menu_0131220036_0 = new Menu("root",165,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,false,false);
  mm_menu_0131220036_0.addMenuItem("Danh&nbsp;sách&nbsp;loại&nbsp;sản&nbsp;phẩm","location='admin.php?go=category_list&page=1'");
  mm_menu_0131220036_0.addMenuItem("Thêm&nbsp;mới&nbsp;loại&nbsp;sản&nbsp;phẩm","location='admin.php?go=category_add'");
   mm_menu_0131220036_0.hideOnMouseOut=true;
   mm_menu_0131220036_0.bgColor='#FDFBFA';
   mm_menu_0131220036_0.menuBorder=1;
   mm_menu_0131220036_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0131220036_0.menuBorderBgColor='#FFFFFF';


  window.mm_menu_0131220600_0 = new Menu("root",165,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,false,false);
  mm_menu_0131220600_0.addMenuItem("Danh&nbsp;sách&nbsp;dòng&nbsp;sản&nbsp;phẩm","location='admin.php?go=model_list&page=1'");
  mm_menu_0131220600_0.addMenuItem("Thêm&nbsp;mới&nbsp;dòng&nbsp;sản&nbsp;phẩm","location='admin.php?go=model_add'");
   mm_menu_0131220600_0.hideOnMouseOut=true;
   mm_menu_0131220600_0.bgColor='#FDFBFA';
   mm_menu_0131220600_0.menuBorder=1;
   mm_menu_0131220600_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0131220600_0.menuBorderBgColor='#FFFFFF';

  window.mm_menu_0131221020_0 = new Menu("root",170,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,true,false);
  mm_menu_0131221020_0.addMenuItem("Danh&nbsp;sách&nbsp;nhà&nbsp;cung&nbsp;cấp","location='admin.php?go=supplier_list&page=1'");
  mm_menu_0131221020_0.addMenuItem("Thêm&nbsp;mới&nbsp;nhà&nbsp;cung&nbsp;cấp","location='admin.php?go=supplier_add'");
   mm_menu_0131221020_0.hideOnMouseOut=true;
   mm_menu_0131221020_0.bgColor='#FDFBFA';
   mm_menu_0131221020_0.menuBorder=1;
   mm_menu_0131221020_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0131221020_0.menuBorderBgColor='#FFFFFF';

  window.mm_menu_0207004831_0 = new Menu("root",170,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,false,false);
    mm_menu_0207004831_0.addMenuItem("Hóa&nbsp;Đơn","location='admin.php?go=ordlist&page=1'");
  mm_menu_0207004831_0.addMenuItem("Danh&nbsp;sách&nbsp;tin&nbsp;tức","location='admin.php?go=news_list&page=1'");
  mm_menu_0207004831_0.addMenuItem("Thêm&nbsp;tin&nbsp;tức","location='admin.php?go=news_add'");
  mm_menu_0207004831_0.addMenuItem("Danh&nbsp;sách&nbsp;câu&nbsp;hỏi","location='admin.php?go=question_list&page=1'");
  mm_menu_0207004831_0.addMenuItem("Thêm&nbsp;câu&nbsp;hỏi","location='admin.php?go=question_add'");
  mm_menu_0207004831_0.addMenuItem("Danh&nbsp;sách&nbsp;khách&nbsp;hàng","location='admin.php?go=customer_list&page=1'");
   mm_menu_0207004831_0.addMenuItem("Phản&nbsp;hồi&nbsp;của&nbsp;khách hàng ","location='admin.php?go=feelist&page=1'");
   
   mm_menu_0207004831_0.hideOnMouseOut=true;
   mm_menu_0207004831_0.bgColor='#FDFBFA';
   mm_menu_0207004831_0.menuBorder=1;
   mm_menu_0207004831_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0207004831_0.menuBorderBgColor='#FFFFFF';


  window.mm_menu_0221040213_0 = new Menu("root",170,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,true,true);
   mm_menu_0221040213_0.hideOnMouseOut=true;
   mm_menu_0221040213_0.bgColor='#FDFBFA';
   mm_menu_0221040213_0.menuBorder=1;
   mm_menu_0221040213_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0221040213_0.menuBorderBgColor='#FFFFFF';
   
    window.mm_menu_0207004832_0 = new Menu("root",200,25,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#999999","#FFFF66","left","middle",3,0,500,-5,7,true,true,true,5,false,false);
    mm_menu_0207004832_0.addMenuItem("Biểu&nbsp;đồ&nbsp;thống&nbsp;kê&nbsp;chung","location='admin.php?go=chart_increase'");
   
   mm_menu_0207004832_0.hideOnMouseOut=true;
   mm_menu_0207004832_0.bgColor='#FDFBFA';
   mm_menu_0207004832_0.menuBorder=1;
   mm_menu_0207004832_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0207004832_0.menuBorderBgColor='#FFFFFF';

mm_menu_0221040213_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="javascript/mm_menu.js"></script>
<script language="JavaScript1.2">mmLoadMenus();</script>
<link rel="stylesheet" href="style/style.css" type="text/css" />

<title>QUẢN TRỊ HỆ THỐNG</title>
</head>

<body bgcolor="#666666">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="lavender">
  <tr>
    <td    align="center" valign="middle"><?php require('wellcome.php');?></td>
  </tr>
  <tr>
    <td>
<div class="menungang">
<ul>
<li><a href="admin.php?go=category_list&amp;page=1" name="link2" id="link2" onMouseOver="MM_showMenu(window.mm_menu_0131220036_0,0,32,null,'link2')" onMouseOut="MM_startTimeout();" >Loại sản phẩm</a></li>
<li><a href="admin.php?go=supplier_list&amp;page=1" name="link3" id="link3" onMouseOver="MM_showMenu(window.mm_menu_0131221020_0,0,32,null,'link3')" onMouseOut="MM_startTimeout();" >Nhà cung cấp</a></li>
<li><a href="admin.php?go=model_list&amp;page=1" name="link4" id="link4" onMouseOver="MM_showMenu(window.mm_menu_0131220600_0,0,32,null,'link4')" onMouseOut="MM_startTimeout();" >Dòng sản phẩm</a></li>
<li><a href="admin.php?go=product_list&amp;page=1" name="link1" id="link1" onMouseOver="MM_showMenu(window.mm_menu_0131215634_0,0,32,null,'link1')" onMouseOut="MM_startTimeout();" >Sản Phẩm</a></li>
<li><a href="admin.php?go=home" name="link5" id="link5" onMouseOver="MM_showMenu(window.mm_menu_0207004831_0,0,32,null,'link5')" onMouseOut="MM_startTimeout();" >Quản lý khác</a></li>
<li><a href="admin.php?go=bieudo" name="link6" id="link6" onMouseOver="MM_showMenu(window.mm_menu_0207004832_0,0,32,null,'link6')" onMouseOut="MM_startTimeout();" >Biểu đồ thống kê</a></li>
</ul>
</div>
	</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top"><?php require("content.php");?></td>
  </tr>
  
  <tr>
    <td height="20" align="center" valign="top">
	<hr class="hr" />
	</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td height="50" align="center" valign="top">
	<div style=" font-style:italic; font-size:14px; font-weight:bold; color: #666666;font-family: Tahoma;">
		Trần Quang Dũng -HanoiAptech
		  <p>
		QUẢN TRỊ WEBSITE </p> 
	  </div>
	</td>
  </tr>
</table>
</body>
</html>


