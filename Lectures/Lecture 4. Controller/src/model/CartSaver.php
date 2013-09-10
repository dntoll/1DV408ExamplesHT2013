<?php

namespace model;

class CartSaver {

	private static $sessionLocation = "model::CartSaver::cart";

	public function __construct() {
		assert(isset($_SESSION));
	}

	/**
	 * @return Cart
	 */
	public function load() {
		if (isset($_SESSION[self::$sessionLocation])) {
			return $_SESSION[self::$sessionLocation];
		}
		return new Cart();
	}	

	public function save(Cart $cart) {
		$_SESSION[self::$sessionLocation] = $cart;
	}
}