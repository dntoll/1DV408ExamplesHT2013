<?php

namespace view;

class Navigation {

	private static $createOrder = "createOrder";
	private static $checkReceipt = "showReceipt";

	public function reloadToFrontpage() {
		header("Location: index.php");
	}

	/**
	 * @return boolean
	 */
	public function userCreatesOrder() { 
		return isset($_GET[self::$createOrder]);
	}

	public function getCheckoutLink() {
		return "<a href='?" . self::$createOrder. " '>Gå till kassan</a>";
	}

	public function getOrderLink() {
		return self::$createOrder;
	}

	public function goToReceipt() {
		header("Location: index.php?" . self::$checkReceipt);
	}

	public function userChecksReceipt() {
		return isset($_GET[self::$checkReceipt]);
	}
}