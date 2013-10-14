<?php

namespace model;


//@todo duplicated code with Cartsaver
class OrderSessionSaver {
	/**
	 * Location in $_SESSION for the Order
	 * @var string
	 */
	private $sessionLocation = "model::OrderSessionSaver::order";

	/**
	 * @param String $stringKey Must be unique for each object
	 */
	public function __construct($stringKey) {
		//show error if session does not exist!
		assert(isset($_SESSION));

		$this->sessionLocation .= $stringKey;
	}

	/**
	 * @return Order
	 */
	public function load() {
		assert($this->hasOrderSaved());

		return $_SESSION[$this->sessionLocation];
	
	}	

	public function hasOrderSaved() {
		return isset($_SESSION[$this->sessionLocation]);
	}

	/**
	 * @param  Order   $cart cart to save
	 */
	public function save(Order $order) {
		$_SESSION[$this->sessionLocation] = $order;
	}

	public function remove() {
		unset($_SESSION[$this->sessionLocation]);
	}
}