<?php

namespace view;

class OrderView {
	private static $completeOrderButton = "completeOrder";

	/**
	 * @param viewNavigation $navigationView [description]
	 */
	public function __construct(\view\Navigation $navigationView) {
		$this->navigationView = $navigationView;
	}

	/**
	 * @return boolean [description]
	 */
	public function hasAdress() {
		if (isset($_POST["adress"]) &&
			$_POST["adress"] != "") {
			return true;
		}

		
		return false;
	}

	/**
	 * @return \model\ValidAdress
	 */
	public function getAdress() {
		assert($this->hasAdress());

		$rawInput = $_POST["adress"];

		$trimmed = trim($rawInput);
		$noTags = htmlentities($trimmed);

		return new \model\ValidAdress($noTags);

	}

	/**
	 * @return String HTML
	 */
	public function getAdressForm(\model\Adress $adress) {
		$orderLink = $this->navigationView->getOrderLink();

		//@todo fix adress persistance output
		$street = $adress->getStreet();
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

	/**
	 * @return boolean
	 */
	public function userCompletesOrder() {
		return isset($_GET[self::$completeOrderButton]);
	}

	/**
	 * 
	 * @param  modelOrder $order [description]
	 * @param  viewCart   $cart  [description]
	 * @return String HTML
	 */
	public function showReceipt(\model\Order $order, \view\Cart $cart) {

		
		$adress = $order->getAdress();
		$street = $adress->getStreet();
		

		$orderLines = $cart->getFixedCartHTML($order->getCart());

		return "<h2>receipt for order</h2> 
				$orderLines 
				<h3>Adress</h3>
				$street";
	}
}