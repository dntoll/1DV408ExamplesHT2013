<?php

namespace model;

class PersistantMessage {
	/**
	 * Location in $_SESSION to hold last message 
	 * @var string
	 */
	private static $messageHolder = "model::Cart::ActionSuccess";
	
	/**
	 * Message 
	 * @var boolean
	 */
	private static $addProductSucceded = true;

	/**
	 * Message 
	 * @var boolean
	 */
	private static $removeProductSucceded = false;
	

	public function __construct() {
		assert(isset($_SESSION));
	}


	public function succededToAddProduct() {
		$_SESSION[self::$messageHolder] = self::$addProductSucceded;
	}

	public function succededToRemoveProduct() {
		$_SESSION[self::$messageHolder] = self::$removeProductSucceded;
	}

	public function removeMessages() {
		unset($_SESSION[self::$messageHolder]);
	}

	public function didBuyProduct() {
		return isset($_SESSION[self::$messageHolder]) && 
				$_SESSION[self::$messageHolder] == self::$addProductSucceded;
	}

	public function didRemoveProduct() {
		return isset($_SESSION[self::$messageHolder]) && 
				$_SESSION[self::$messageHolder] == self::$removeProductSucceded;
	}
	
	
}