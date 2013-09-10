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
	 * @param  \model\ProductList $productList
	 * @return String HTML                  
	 */
	public function getProductList(\model\ProductList $productList) {

		$productArray = $productList->getProductArray();
		$products = "";
		foreach ($productArray AS $productIndex => $product) {
			//$product is a \model\Product
			$productLink = $this->getProductLink($product);
			$products = $products . "<li>" . $product->getName() . " $productLink</li>";
		}

		return "<ul>$products</ul>";
	}
	
	/**
	 * @return Boolean true if user wants to buy a product
	 */
	public function userBuysProduct() {
		return isset($_GET[self::$buyButton]);
	}


	/**
     * @return \model\Product
	 */
	public function getSelectedProduct(\model\ProductList $productList) {

		$unique = $_GET[self::$buyButton];
		$product = $productList->getProduct($unique);

		return $product;
	}

	/**
	 * @param  modelProduct $product
	 * @return String HTML 
	 */
	private function getProductLink(\model\Product $product) {
		return "<a href='?" . self::$buyButton ."=" . $product->getUnique() . "' >buy</a> ";
	}


	
}