<?php
	$callPage=$_REQUEST['go'];
	switch ($callPage)
		{
		// Log change
			case 'logchange':
				require('logchange.php');
				break;
		//Category list
			case 'category_list':
				require('category/category_list.php');
				break;		
			case "category_add":
				require('category/category_add.php');	
				break;
			case "category_edit":
				require('category/category_edit.php');
				break;	
	
	//Suplier list
		    case 'supplier_list':
				require('supplier/supplier_list.php');
				break;		
			case "supplier_add":
				require('supplier/supplier_add.php');	
				break;
			case "supplier_edit":
				require('supplier/supplier_edit.php');
				break;	
	//Model list
	        case "model_list":
				require('model/model_list.php');
				break;	
			case "model_add":
				require('model/model_add.php');
				break;
			case "model_edit":
				require('model/model_edit.php');
				break;		
	// search
			case "search":
				require("search/search.php");
				break;
	
	//Product list
			case "process":
				require('product/Upload_images/prosess.php');	
				break;			
			case "upload_img":
				require('product/Upload_images/upload.php');	
				break;
			case "upload_img_add":
				require('product/Upload_images/upload_add.php');	
				break;
			case "process_upload_imgAdd":
				require('product/Upload_images/process_upload_imgAdd.php');	
				break;		
			case "product_list":
				require('product/product_list.php');	
				break;
			case "product_add_process":
				require('product/product_add_process.php');	
				break;	
			case "product_add_new":
				require('product/product_add_new.php');	
				break;
			case "product_edit":
				require('product/product_edit.php');	
				break;		
				
					
		// Spec list		
			case "spec_list":
				require('Specifications/spec_list.php');	
				break;
			case "spec_add":
				require('Specifications/spec_add.php');	
				break;
			case "spec_edit":
				require('Specifications/spec_edit.php');	
				break;
		//Question list		
				
			case "question_list":
				require('question/question_list.php');	
				break;
			case "question_add":
				require('question/question_add.php');	
				break;
			case "customer_list":
				require('customer/customer_list.php');	
				break;	
			//News list		
		    case "news_list":
				require('news/news_list.php');	
				break;
			case "news_add":
				require('news/news_add.php');	
				break;
			case "news_edit":
				require('news/news_edit.php');	
				break;	
			case "news_detail":
				require('news/news_detail.php');	
				break;
		// Chart increase
		case "chart_increase":
			require('chart/chart_increase.php');
			break;
		//Order List			
		case "ordlist":
			require("orders/orderlist.php");
			break;
		case "orddetail":
			require("orders/orderdetail.php");
			break;
		//Fee_list	
		case  "feelist":
			require("feedback/feedbacklist.php");
			break;	
		case  "procolor":
			require("proColor/procolor_list.php");
			break;
		case  "procolor_add":
			require("proColor/procolor_add.php");
			break;		
		default :
				require("home.php");
				break;						
			
		}
		
?>
