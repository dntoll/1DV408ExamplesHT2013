<?php

namespace controller;

require_once("src/model/Cart.php");


class BuyProducts {

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

	private $productList;

	private $cart;

	public function __construct(\model\ProductList $productList) {
		$this->productListView =  new \view\ProductList();
		$this->productList = $productList;

		$this->cart = new \model\Cart();
	}

	public function buyProducts() {
		//hantera indata
		//
		if ($this->productListView->userBuysProduct()) {
			$product = $this->productListView->getProduct();

			$this->cart->addProduct($product);
		}
		

		//genera utdata mha vyer
		$productListHTML = $this->productListView->getProductList($this->productList);

		return $productListHTML;
	}
}