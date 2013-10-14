<?php

namespace model;

class Order {

	/**
	 * @var ValidAdress
	 */
	public $adress;

	/**
	 * @var Cart
	 */
	private $cart;


	/**
	 * @param ValidAdress $adress [description]
	 * @param Cart        $cart   [description]
	 */
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