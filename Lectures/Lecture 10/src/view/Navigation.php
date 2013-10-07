<?php

namespace view;

class Navigation {

	private static $createOrder = "createOrder";

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
}