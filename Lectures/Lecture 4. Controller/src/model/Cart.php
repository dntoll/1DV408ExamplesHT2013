<?php

namespace model;

class Cart {

	/**
	 * 
	 * @var array of ProductLines
	 */
	private $productLines;


	public function __construct() {
		$this->productLines = array();
	}


	public function addProduct(Product $product) {
		//if not in cart add new
		$this->productLines[] = new ProductLine($product)
		else increment productLine

	}

	public function getProductLines() {
		return array();
	}
}