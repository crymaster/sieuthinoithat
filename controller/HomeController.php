<?php
/**
 * Controller for home page
 */
class HomeController extends Controller {
	const MODEL_PRODUCT = 'ProductModel';
	const VIEW_HOME = 'home.php';
	
	public function index() {
		$product_model = $this->loadModel(self::MODEL_PRODUCT);
		$best_sale_list = $product_model->getBestSaleProduct();
		$this->render(self::VIEW_HOME, array('product_list' => $best_sale_list));
	}
}

?>