<?php

namespace view;

require_once("\src\model\Product.php");
require_once("\src\model\ProductList.php");

class ProductList {
	private static $buyButton = "buy";

	public function getProductList(\model\ProductList $productList) {

		$productArray = $productList->getProductArray();
		$products = "";
		foreach ($productArray AS $productIndex => $product) {
			//$product är nu en \model\Product
			//
			$productLink = $this->getProductLink($product);
			$products = $products . "<li>" . $product->getName() . " $productLink</li>";
		}

		return "<ul>$products</ul>";
	}
	
	/**
	 * @return Boolean [description]
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