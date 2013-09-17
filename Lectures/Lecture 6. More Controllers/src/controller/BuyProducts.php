<?php

namespace controller;

require_once("src/model/Cart.php");
require_once("src/view/Cart.php");


class BuyProducts {

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

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

		$this->cartView = new \view\Cart($this->cart);
	}

	/**
	 * @return String HTML
	 */
	public function buyProducts() {
		//handle input
		if ($this->productListView->userBuysProduct()) {

			try {
				$product = $this->productListView->getSelectedProduct($this->productList);
				//make changes in model
				$this->cart->addProduct($product);
			} catch(\Exception $e) {
			
			} 
		}
		

		//generate output (using views)
		$productListHTML = $this->productListView->getProductList($this->productList);
		$cartHTML = $this->cartView->getCartHTML();
		return $productListHTML . $cartHTML;
	}
}