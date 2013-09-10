<?php

namespace model;

class ProductList {

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

	/**
	 * [getProductArray description]
	 * @return array of Product 
	 */
	public function getProductArray() {
		return $this->products;
	}

	public function getProduct($uniqueIndex) {
		return $this->products[$uniqueIndex];
	}
}