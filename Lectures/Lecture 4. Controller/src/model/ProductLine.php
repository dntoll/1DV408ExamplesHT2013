<?php

namespace model;

class ProductLine {

	/**
	 * @var Product
	 */
	private $product;

	/**
	 * @var float
	 */
	private $amount;


	public function __construct(Product $product) {
		$this->product = $product;
		$this->amount = 1;
	}

	/**
	 * @return Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * @return int
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @return float SEK
	 */
	public function getTotalSEK() {
		return $this->getAmount() * $this->product->getCostSEK();
	}

	public function increment() {
		$this->amount++;
	}
}