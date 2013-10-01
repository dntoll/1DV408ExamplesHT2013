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
	private $productListController;
	private $navigationView;

	public function __construct() {

		//Initiate model
		$this->productList = new \model\ProductList();
		$this->productList->add(new \model\Product("Banana", "Banan", 5.5));
		$this->productList->add(new \model\Product("Peaches", "Peach", 3.33));

		$this->cartSaver = new \model\CartSaver();

		$this->cart = $this->cartSaver->load();

 		$this->productListView = new \view\ProductList();

		$this->navigationView = new \view\Navigation();

		$this->cartView = new \view\Cart($this->cart, 
										$this->productListView,
										$this->navigationView);

		$this->productListController = new \controller\BuyProducts($this->productList, 
																 $this->cart,
																 $this->navigationView,
																 $this->productListView,
																 $this->cartView);
	}

	/**
	 * @return String HTML
	 */
	public function doApplication() {


		//run controllers
		if ($this->navigationView->userCreatesOrder() && 
			$this->cart->containsItems()) {


			$html = $this->doOrderHandling();
			
		} else {
			
			$html = $this->productListController->buyProducts();
			$this->cartSaver->save($this->cart);
		}

		return $html;
	}

	/**
	 * @return String HTML
	 */
	private function doOrderHandling() {
		$orderView = new \view\OrderView($this->navigationView);
		$orderController = new \controller\OrderProducts($orderView,
														$this->cartView);

		if ($orderView->userHasCompletedOrder()) {
			$html = $orderView->showReceipt();
		} else {
			$html = $orderController->createOrder();
		}

		return $html;
	}
}