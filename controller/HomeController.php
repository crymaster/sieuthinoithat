<?php
/**
 * Controller for home page
 */
class HomeController extends Controller {
	const VIEW_HOME = 'home.php';
	
	public function index() {
		$product_model = $this->loadModel(MODEL_PRODUCT);
		$best_sale_list = $product_model->getBestSaleProduct();
		$recent_product = array();
		$cart_related_product = array();
		if (isset($_SESSION[CUSTOMER_ID])){
			$recent_product = $product_model->getRecentViewProduct($_SESSION[CUSTOMER_ID]);
		}
		if (isset($_SESSION[CART])) {
			$cart = $_SESSION[CART];
			$key_array = array_keys($cart);
			$cart_related_product = $product_model->getRelatedProduct($key_array);
		}
		$product_list = array_merge($cart_related_product, $recent_product, $best_sale_list);
		$product_list = array_unique($product_list, SORT_REGULAR);
		$this->render(self::VIEW_HOME, array('product_list' => $product_list));
	}
}

?>