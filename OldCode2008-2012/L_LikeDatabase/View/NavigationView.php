<?php

namespace View;


class NavigationView {
	private static $ProductID = "ProductID";
	/**
	 * @return boolean
	 */
	public static function isViewingProduct() {
		
		if (isset($_GET[self::$ProductID])) {
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	 * return String URL
	 */
	public static function getProductListLink() {
		return "?";
	}
	
	public static function getProductLink(\Model\Product $product) {
		return "?" . self::$ProductID . "=" . $product->getId();
	}
	
	/**
	 * @return \Model\Product selected product
	 */
	public static function getSelectedProduct(\Model\ProductCatalog $productCatalog, \Model\Database $db) {
		if (isset($_GET[self::$ProductID])) {
			$urlId = $_GET[self::$ProductID];
			
			if ($urlId != "0" && intval($urlId) == 0) {
				throw new \Exception("getSelectedProduct() URL called with wrong format");
			} else { 
				$productID = intval($urlId);
				
				return $productCatalog->getProduct($productID, $db);
				
			} 
		} else {
			throw new \Exception("getSelectedProduct can only be called when we view a product");
		}
	}
}

