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


	public function addProduct(Product $product) {
		
		if ($this->hasProduct($product)) {
			$pline = $this->getProductLine($product);
			$pline->increment();
		} else {
			//if not in cart add new
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

	private function hasProduct(Product $product) {
		$index = $product->getUnique();
		return isset($this->productLines[$index]);
	}

	private function getProductLine(Product $product) {
		$index = $product->getUnique();
		return $this->productLines[$index];
	}
}