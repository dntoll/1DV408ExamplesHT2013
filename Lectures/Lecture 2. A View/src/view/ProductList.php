<?php

namespace view;

require_once("\src\model\Product.php");
require_once("\src\model\ProductList.php");

class ProductList {
	public function getProductList(\model\ProductList $productList) {

		$productArray = $productList->getProductArray();
		$products = "";
		foreach ($productArray AS $productIndex => $product) {
			//$product är nu en \model\Product
			$products = $products . "<li>" . $product->getName() . "</li>";
		}

		return "<ul>$products</ul>";
	}
}