<?php

/**
 * Controller for product related view
 */
class ProductController extends Controller {
	const VIEW_PRODUCT_DETAIL = 'include/product_detail.php';
	
	public function updateViewNumber() {
		$product_id = $_GET['pid'];
		
		// Check if customer logged in, product id is set and this product is not yet viewed, update view number
		if (isset($_SESSION[CUSTOMER_ID])
			&& isset($_GET['pid'])
			&& !isset($_SESSION[PRODUCT_VIEW][$product_id])) {
			
			$product_model = $this->loadModel(MODEL_PRODUCT);
			$product_model->updateProductViewNumber($_SESSION[CUSTOMER_ID], $product_id);
			$_SESSION[PRODUCT_VIEW][$product_id] = TRUE;
		}
		// $this->render(self::VIEW_PRODUCT_DETAIL, array());
	}
	
}


?>