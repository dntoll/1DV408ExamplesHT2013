<?php

namespace model;

require_once("IProductList.php");

class ArrayProductList implements IProductList {

	/**
	 * @var array of Product 
	 */
	private $products = array();

	/**
	 * @param Product $product
	 */
	public function add(Product $product) {
		$this->products[$product->getUnique()] = $product;
	}

	/** getAllProducts?
	 * @return array of Product 
	 */
	public function getProductArray() {
		return $this->products;
	}

	/**
	 * Get product from unique index
	 * @param  String $uniqueIndex
	 * @return Product
	 */
	public function getProduct($uniqueIndex) {
		return $this->products[$uniqueIndex];
	}


	/**
	 * @param  String  $uniqueIndex 
	 * @return boolean              
	 */
	public function hasProduct($uniqueIndex) {
		return isset($this->products[$uniqueIndex]);
	}
}