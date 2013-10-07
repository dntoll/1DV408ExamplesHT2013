<?php

namespace model;


//@todo duplicated code with Cartsaver
class OrderSessionSaver {
	/**
	 * Location in $_SESSION for the Order
	 * @var string
	 */
	private static $sessionLocation = "model::OrderSessionSaver::order";


	public function __construct() {
		//show error if session does not exist!
		assert(isset($_SESSION));
	}

	/**
	 * @return Order
	 */
	public function load() {
		assert($this->hasOrderSaved());

		return $_SESSION[self::$sessionLocation];
	
	}	

	public function hasOrderSaved() {
		return isset($_SESSION[self::$sessionLocation]);
	}

	/**
	 * @param  Order   $cart cart to save
	 */
	public function save(Order $order) {
		$_SESSION[self::$sessionLocation] = $order;
	}
}