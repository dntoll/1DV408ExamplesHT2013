<?php

namespace model;

class CartSaver {
	/**
	 * Location in $_SESSION for the cart
	 * @var string
	 */
	private static $sessionLocation = "model::CartSaver::cart";


	public function __construct() {
		//show error if session does not exist!
		assert(isset($_SESSION));
	}

	/**
	 * @return Cart
	 */
	public function load() {
		if (isset($_SESSION[self::$sessionLocation])) {
			return $_SESSION[self::$sessionLocation];
		}
		//no existing cart, create new one
		return new Cart();
	}	

	/**
	 * @param  Cart   $cart cart to save
	 */
	public function save(Cart $cart) {
		$_SESSION[self::$sessionLocation] = $cart;
	}
}