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
	 * 
	 * @param model\ProductList $productList     [description]
	 * @param model\Cart        $cart            [description]
	 * @param view\Navigation   $navigationView  [description]
	 * @param view\ProductList  $productListView [description]
	 * @param view\Cart         $cartView        [description]
	 */
	public function __construct(\model\ProductList 	$productList, 
								\model\Cart 		$cart,
								\view\Navigation    $navigationView,
								\view\ProductList   $productListView,
								\view\Cart          $cartView) {
		$this->productListView =  $productListView;
		$this->productList = $productList;

		$this->cart = $cart;

		$this->cartView = $cartView;
		$this->navigationView = $navigationView;
	}

	/**
	 * @return String HTML
	 */
	public function buyProducts() {

		//handle input
		if ($this->productListView->userChangesCart()) {

			try {

				//make changes in model
				$product = $this->productListView->getSelectedProduct($this->productList);
				
				if ($this->productListView->userBuysProduct() ) {
					$this->cart->addProduct($product);
				} else {
					$this->cart->removeProduct($product);
				}

				$this->cartView->setSuccessMessage();
				$this->navigationView->reloadToFrontpage();
				return "";
			} catch(\Exception $e) {
				//Error is handled in view
				
			} 
		}
		
		//generate output (using views)
		$productListHTML = $this->productListView->getProductList($this->productList);
		$cartHTML = $this->cartView->getCartHTML();
		return $productListHTML . $cartHTML;
	}
}