<?php

namespace view;

require_once("\src\model\Product.php");
require_once("\src\model\ProductList.php");

class ProductList {
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
	 * @return Boolean 
	 */
	public function userBuysProduct() {
		return isset($_GET[self::$buyButton]);
	}

	
	/**
	 * @param  modelProduct $product [description]
	 * @return String HTML               [description]
	 */
	private function getProductLink(\model\Product $product) {
		return "<a href='?" . self::$buyButton ."=" . $product->getUnique() . "' >buy</a> ";
	}


	
}