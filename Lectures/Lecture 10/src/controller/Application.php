<?php

namespace controller;

require_once("/src/view/OrderView.php");
require_once("/src/controller/OrderProducts.php");

class Application {
	/**
	 * @var \model\ProductList
	 */
	private $productList;

	/**
	 * @var \model\CartSaver
	 */
	private $cartSaver;

	/**
	 * @var \model\Cart
	 */
	private $cart;

	/**
	 * @var \view\Cart
	 */
	private $cartView;

	/**
	 * @var \controller\BuyProducts
	 */
	private $productListController;

	/**
	 * @var \view\Navigation
	 */
	private $navigationView;

	/**
	 * @var \view\OrderView
	 */
	private $orderView;

	/**
	 * @var \controller\OrderProducts
	 */
	private $orderController;


	public function __construct() {

		//Initiate model
		$this->productList = new \model\ProductList();
		$this->productList->add(new \model\Product("Banana", "Banan", 5.5));
		$this->productList->add(new \model\Product("Peaches", "Peach", 3.33));

		$this->cartSaver = new \model\CartSaver();
		$this->cart = $this->cartSaver->load();

		//initate views
 		$this->productListView = new \view\ProductList();
		$this->navigationView = new \view\Navigation();
		$this->cartView = new \view\Cart($this->cart, 
										$this->productListView,
										$this->navigationView);
		$this->orderView = new \view\OrderView($this->navigationView);

		//Initiate controllers
		$this->productListController = new \controller\BuyProducts($this->productList, 
																 $this->cart,
																 $this->navigationView,
																 $this->productListView,
																 $this->cartView);

		
		$this->orderController = new \controller\OrderProducts($this->orderView,
														$this->cartView);
	}

	/**
	 * @return String HTML
	 */
	public function doApplication() {
		$userWantsToCreateOrder = $this->navigationView->userCreatesOrder();
		$userCanCreateOrder = $this->cart->containsItems();

		//run controllers
		if ($userWantsToCreateOrder && $userCanCreateOrder) {

			$html = $this->orderController->createOrder();
			
		} else {
			$html = $this->productListController->buyProducts();
			$this->cartSaver->save($this->cart);
		}

		return $html;
	}

	
}