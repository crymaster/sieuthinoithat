<?php
	require 'controller/Controller.php';
	$callPage=$_REQUEST['go'];
	switch ($callPage)
		{
		//shopping cart
		case 'shoppingcart':
			require('shoppingcart/shoppingcart.php');
			break;
		case 'shoppingcart_send1':
			require('shoppingcart/shoppingcart_send1.php');
			break;
		case 'shoppingcart_send2':
			require('shoppingcart/shoppingcart_send2.php');
			break;
		case 'shoppingcart_send3':
			require('shoppingcart/shoppingcart_send3.php');
			break;	
		case 'shoppingcart_login':
			require('shoppingcart/shoppingcart_login.php');	
			break;
		//show list product
		
		case 'product_list':
			require('include/product_list.php');
			break;
		case 'product_detail':
			require 'controller/ProductController.php';
			$product_controller = new ProductController();
			$product_controller->updateViewNumber();
			require ('include/product_detail.php');
			break;	
			
		//search
		case 'search':	
			require('search/search.php');	
			break;
		case 'searchadvanced':
			require('search/searchadvanced.php');			
			break;
		case 'temp':
			require('search/temp.php');
			break;	
			
		// news list
		
		case 'news_list':
			require('include/news_list.php');
			break;	
		case 'news_detail':
			require('include/news_detail.php');
			break;	
			
		//Contact
		
		case 'contact':
			require('include/contact.php');
			break;
		// googlemap
		case 'googlemap':
			require('include/googlemap.php');	
			break;
		//search
		
		//log
		case 'register':
			require('log/register.php');
			break;
		case 'login':
			require('log/login.php');	
			break;		
		case 'loginprocess':
			require('log/loginprocess.php');	
			break;					
		case 'logout':
			require('log/logout.php');	
			break;		
		case 'errorlogin':
			require('log/errorlogin.php');	
			break;	
		case 'profile':
			require('log/profile.php');
			break;
		case 'passforgot':
			require('log/passforgot.php');
			break;
		case 'passchange':
			require('log/passchange.php');
			break;			
			
		//home				
		case 'home':
		default :
			require 'controller/HomeController.php';
			$home = new HomeController();
			$home->index();
			break;								
			
		}
		
?>
