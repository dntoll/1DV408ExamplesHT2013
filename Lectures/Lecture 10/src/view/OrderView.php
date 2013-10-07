<?php

namespace view;

class OrderView {
	private static $completeOrderButton = "completeOrder";

	public function __construct(\view\Navigation $navigationView) {
		$this->navigationView = $navigationView;
	}

	public function hasAdress() {
		if (isset($_POST["adress"]) &&
			$_POST["adress"] != "") {
			return true;
		}

		
		return false;
	}

	/**
	 * @return \model\Adress
	 */
	public function getAdress() {
		assert($this->hasAdress());

		$rawInput = $_POST["adress"];

		$trimmed = trim($rawInput);
		$noTags = htmlentities($trimmed);

		return new \model\Adress($noTags);

	}

	/**
	 * @return String HTML
	 */
	public function getAdressForm($adress) {
		$orderLink = $this->navigationView->getOrderLink();

		@todo fix adress persistance output
		$street = $adress->getAdress();
		return "<h2>Adressform</h2>
				<form action='?$orderLink' method='post'>
					Adress: <input type='text' name='adress' value='$street'/>
					<input type='submit' value='skicka' name='skicka'/>
				</form>
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

	public function userCompletesOrder() {
		return isset($_GET[self::$completeOrderButton]);
	}

	public function showReceipt() {
		return "<h2>receipt for order</h2>";
	}
}