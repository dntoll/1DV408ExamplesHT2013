<?php

namespace controller;

require_once("src/model/Cart.php");
require_once("src/view/Cart.php");
require_once("src/view/Navigation.php");


class BuyProducts {

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

	/**
	 * @var \view\Navigation
	 */
	private $navigationView;


	/**
	 * @var \model\ProductList $productList
	 */
	private $productList;

	/**
	 * @var \model\Cart
	 */
	private $cart;

	/**
	 * @param \model\ProductList $productList
	 * @param \model\Cart $cart
	 */
	public function __construct(\model\ProductList 	$productList, 
								\model\Cart 		$cart) {
		$this->productListView =  new \view\ProductList();
		$this->productList = $productList;

		$this->cart = $cart;

		$this->cartView = new \view\Cart($this->cart, $this->productListView);
		$this->navigationView = new \view\Navigation();
	}

	/**
	 * @return String HTML
	 */
	public function buyProducts() {

		$reload = false;
		//handle input
		//@todo: fix duplication
		if ($this->productListView->userBuysProduct()) {

			try {
				$product = $this->productListView->getSelectedProduct($this->productList);
				//make changes in model
				$this->cart->addProduct($product);

				$this->cartView->addBuySuccessMessage();
				$reload = true;
			} catch(\Exception $e) {
				
			} 
		}
		if ($this->productListView->userRemovesProduct()) {

			try {
				$product = $this->productListView->getSelectedProduct($this->productList);
				//make changes in model
				$this->cart->removeProduct($product);

				$this->cartView->addRemoveSuccessMessage();
				$reload = true;
			} catch(\Exception $e) {
				
			} 
		}
		
		if ($reload) {

			$this->navigationView->reloadToFrontpage();
			
		} else {
			//generate output (using views)
			$productListHTML = $this->productListView->getProductList($this->productList);
			$cartHTML = $this->cartView->getCartHTML();
			return $productListHTML . $cartHTML;
		}
	}
}