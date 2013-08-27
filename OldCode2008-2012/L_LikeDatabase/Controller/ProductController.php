<?php


//TODO: namespace controller
namespace Controller;

class ProductControllerOutput {
	public $m_likeHtml = "";
	public $m_productHtml = "";
}

class ProductController {
	
	/**
	 * @return ProductControllerOutput 
	 */
	public function doControll(\Model\Database $db, \Model\ProductCatalog $productCatalog) {
		
		//Run the controller(s)
		$likeController = new LikeController();
		$view = new \View\LikeView();
		$productView = new \View\ProductView();
		
		//\Model\Product $product
		$product = \View\NavigationView::getSelectedProduct($productCatalog, $db);
		
		
		
		$out = new ProductControllerOutput();
		$out->m_likeHtml = $likeController->doControll($db, $view);
		
		$out->m_productHtml = $productView->showProduct($product);
		
		return $out;
	}
}
