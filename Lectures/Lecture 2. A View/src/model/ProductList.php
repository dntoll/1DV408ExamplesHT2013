<?php

namespace model;

class ProductList {

	/**
	 * @var array of Product 
	 */
	private $products = array();


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
}