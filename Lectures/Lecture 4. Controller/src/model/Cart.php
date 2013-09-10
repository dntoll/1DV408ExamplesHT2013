<?php

namespace model;

require_once("ProductLine.php");

class Cart {

	/**
	 * 
	 * @var array of ProductLines
	 */
	private $productLines;


	public function __construct() {
		$this->productLines = array();
	}

	/**
	 * Adds a product to the cart
	 * if the product already exists increment the amount of products
	 * 
	 * @param Product $product 
	 */
	public function addProduct(Product $product) {
		
		if ($this->hasProduct($product)) {
			//We have a product in the cart
			$pline = $this->getProductLine($product);
			$pline->increment();
		} else {
			//new productLine!
			$index = $product->getUnique();
			$this->productLines[$index] = new ProductLine($product);
		}
	}

	/**
	 * @return array of ProductLine
	 */
	public function getProductLines() {
		return $this->productLines;
	}

	/**
	 * @param  Product $product
	 * @return boolean true if product already is in cart
	 */
	private function hasProduct(Product $product) {
		$index = $product->getUnique();
		return isset($this->productLines[$index]);
	}

	/**
	 * @param  Product $product 
	 * @return ProductLine          
	 */
	private function getProductLine(Product $product) {
		$index = $product->getUnique();
		return $this->productLines[$index];
	}
}