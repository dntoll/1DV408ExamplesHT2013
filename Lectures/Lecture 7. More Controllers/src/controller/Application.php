<?php

namespace controller;

require_once("/src/view/OrderView.php");
require_once("/src/controller/OrderProducts.php");

class Application {
	//@todo document!
	private $productList;
	private $cartSaver;
	private $cart;
	private $cartView;

	public function __construct() {

		//Initiate model
		$this->productList = new \model\ProductList();
		$this->productList->add(new \model\Product("Banana", "Banan", 5.5));
		$this->productList->add(new \model\Product("Peaches", "Peach", 3.33));

		$this->cartSaver = new \model\CartSaver();

		$this->cart = $this->cartSaver->load();

 		$this->productListView = new \view\ProductList();
		$this->cartView = new \view\Cart($this->cart, $this->productListView);
	}

	/**
	 * @return String HTML
	 */
	public function doApplication() {


		//run controllers
		if ($this->cartView->userCreatesOrder() && 
			$this->cart->containsItems() ) {
			$orderView = new \view\OrderView();
			$orderController = new \controller\OrderProducts($orderView);

			if ($orderView->userHasCompletedOrder()) {
				$html = $orderController->showReceipt();
			} else {
				$html = $orderController->createOrder();
			}
			
		} else {
			$productListController = new \controller\BuyProducts($this->productList, 
																 $this->cart,
																 $this->cartView,
																 $this->productListView);
			$html = $productListController->buyProducts();

			$this->cartSaver->save($this->cart);
		}

		return $html;
	}
}