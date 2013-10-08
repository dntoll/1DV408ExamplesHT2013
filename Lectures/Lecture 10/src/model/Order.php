<?php

namespace model;

class Order {

	/**
	 * @var ValidAdress
	 */
	private $adress;

	/**
	 * @var Cart
	 */
	private $cart;

	public function __construct(ValidAdress $adress, Cart $cart) {
		$this->adress = $adress;
		$this->cart = $cart;
	}

	/**
	 * @return ValidAdress
	 */
	public function getAdress() {
		return $this->adress;
	}

	/**
	 * @return Cart
	 */
	public function getCart() {
		return $this->cart;
	}
}