<?php

namespace view;

require_once("\src\model\Product.php");
require_once("\src\model\ProductList.php");

class ProductList {
	/**
	 * The location in $_GET where the product unique key exists 
	 * @var string
	 */
	private static $buyButton = "buy";

	/**
	 * @var string
	 */
	private static $removeButton = "remove";

	/**
	 * @var string
	 */
	private $message = "";

	//@todo add __construct with ProductList parameter

	/**
	 * @param  \model\ProductList $productList
	 * @return String HTML                  
	 */
	public function getProductList(\model\ProductList $productList) {

		$productArray = $productList->getProductArray();
		$products = "";
		foreach ($productArray AS $productIndex => $product) {
			//$product is a \model\Product
			$productLink = $this->getBuyProductLink($product, "buy");
			$products = $products . "<li>" . $product->getName() . " $productLink</li>";
		}

		return "<ul>$products</ul> $this->message";
	}
	
	/**
	 * @return Boolean true if user wants to buy a product
	 */
	public function userBuysProduct() {
		return isset($_GET[self::$buyButton]);
	}

	/**
	 * @return Boolean true if user wants to buy a product
	 */
	public function userChangesCart() {
		return $this->userBuysProduct() || $this->userRemovesProduct();
	}

	/**
	 * @return Boolean true if user wants to buy a product
	 */
	private function userRemovesProduct() {
		return isset($_GET[self::$removeButton]);
	}

	


	/**
     * @return \model\Product
     *
     * @throws Exception If Product name does not exist
	 */
	public function getSelectedProduct(\model\ProductList $allProducts) {

		if (isset( $_GET[self::$buyButton])) {
			$unique = $_GET[self::$buyButton];
		} else {
			$unique = $_GET[self::$removeButton];
		}

		if ($allProducts->hasProduct($unique)) {
			$product = $allProducts->getProduct($unique);
			return $product;
		}

		$this->message = "Cannot find that product, please select a proper product!";
		throw new \Exception("Cannot find product $unique");
	}

	/**
	 * @param  modelProduct $product
	 * @return String HTML 
	 */
	public function getBuyProductLink(\model\Product $product, $title) {
		return "<a href='?" . self::$buyButton ."=" . $product->getUnique() . "' >$title</a> ";
	}

	/**
	 * @param  modelProduct $product
	 * @return String HTML 
	 */
	public function getRemoveProductLink(\model\Product $product, $title) {
		return "<a href='?" . self::$removeButton ."=" . $product->getUnique() . "' >$title</a> ";
	}


	
}