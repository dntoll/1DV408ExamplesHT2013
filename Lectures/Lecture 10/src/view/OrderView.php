<?php

namespace view;

class OrderView {
	private static $completeOrderButton = "completeOrder";

	public function __construct(\view\Navigation $navigationView) {
		$this->navigationView = $navigationView;
	}

	public function hasAdress() {
		return false;
	}

	/**
	 * @return String HTML
	 */
	public function getAdressForm() {

		@todo lägg till information för formulär
		return "<h2>Adressform</h2>

				";
	}

	/**
	 * @todo  must add createOrder to the URL
	 * @return String HTML
	 */
	public function getCompleteOrderButton() {

		$orderLink = $this->navigationView->getOrderLink();
		return "<a href='?$orderLink&" . self::$completeOrderButton . "'>complete order</a>";
	}

	public function userHasCompletedOrder() {
		return isset($_GET[self::$completeOrderButton]);
	}

	public function showReceipt() {
		return "<h2>receipt for order</h2>";
	}
}