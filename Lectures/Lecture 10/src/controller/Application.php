<?php

namespace controller;

require_once("/src/view/OrderView.php");
require_once("/src/controller/OrderProducts.php");
require_once("/src/controller/CartSwapper.php");
require_once("/src/model/ArrayProductList.php");


class Application implements CartSwapper {
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


	public function __construct(\model\IProductList $productList) {

		//Initiate model
		$this->productList = $productList;


		$this->cartSaver = new \model\CartSaver();
		$this->cart = $this->cartSaver->load();

		//initate views
 		$this->productListView = new \view\ProductList();
		$this->navigationView = new \view\Navigation();
		$persistantMessage = new \model\PersistantMessage();
		$this->cartView = new \view\Cart($this->productListView,
										$this->navigationView, 
										$persistantMessage);
		$this->orderView = new \view\OrderView($this->navigationView);

		//Initiate controllers
		$this->productListController = new \controller\BuyProducts($this->productList, 
																 $this->cart,
																 $this->navigationView,
																 $this->productListView,
																 $this->cartView,
																 $persistantMessage);

		
		$this->orderController = new \controller\OrderProducts($this->orderView,
															   $this->cartView,
															   $this->cart,
															   $this->navigationView);
	}

	/**
	 * @return String HTML
	 */
	public function doApplication() {
		$userWantsToCreateOrder = $this->navigationView->userCreatesOrder();
		$userCanCreateOrder = $this->cart->containsItems();
		$showReceipt = $this->navigationView->userChecksReceipt();

		//run controllers
		if ($userWantsToCreateOrder && $userCanCreateOrder) {

			$html = $this->orderController->createOrder($this);
			
		} else if ($showReceipt) {
			$html = $this->orderController->showReceipt();

		} else {

			$html = $this->productListController->buyProducts();
			
		}
		$this->cartSaver->save($this->cart);

		return $html;
	}

	/**
	 * part of CartSwapper
	 * @return [type] [description]
	 */
	public function newCart() {
		$this->cart = new \model\Cart();
	}
	
}