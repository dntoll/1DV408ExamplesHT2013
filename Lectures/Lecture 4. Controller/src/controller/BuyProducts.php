<?php

namespace controller;

require_once("src/model/Cart.php");


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
	 */
	public function __construct(\model\ProductList $productList,
								\view\ProductList $listView) {
		$this->productListView =  $listView;
		$this->productList = $productList;

		$this->cart = new \model\Cart();
	}

	/**
	 * @return String HTML
	 */
	public function buyProducts() {
		//handle input
		if ($this->productListView->userBuysProduct()) {
			$product = $this->productListView->getProduct();

			//make changes in model
			$this->cart->addProduct($product);
		}
		

		//generate output (using views)
		$productListHTML = $this->productListView->getProductList($this->productList);

		return $productListHTML;
	}
}