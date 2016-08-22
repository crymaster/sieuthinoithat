<?php
/**
 * Controller for home page
 */
class HomeController extends Controller {
	const VIEW_HOME = 'home.php';
	
	public function index() {
		$product_model = $this->loadModel(MODEL_PRODUCT);
		$best_sale_list = $product_model->getBestSaleProduct();
		$this->render(self::VIEW_HOME, array('product_list' => $best_sale_list));
	}
}

?>