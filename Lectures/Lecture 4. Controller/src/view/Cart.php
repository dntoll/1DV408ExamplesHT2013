<?php

namespace view;



class Cart {

	/**
	 * @var \model\Cart
	 */
	private $cart;

	public function __construct(\model\Cart $cart) {
		$this->cart = $cart;
	}

	public function getCartHTML() {
		$productLines = $this->cart->getProductLines();

		$html = "<ul>";
		foreach ($productLines as $productLine) {
			$product = $productLine->getProduct();
			$name = $product->getName();
			$costSEK = $product->getCostSEK();
			$amount = $productLine->getAmount();
			$totalSEK = $productLine->getTotalSEK();

			$html .= "<li>$name $amount x $costSEK = $totalSEK SEK</li>";

		}
		$html .= "</ul>";

		return "<h2>Cart</h2> $html";
	}
}