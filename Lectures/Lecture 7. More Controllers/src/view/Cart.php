<?php

namespace view;



class Cart {

	/**
	 * @var \model\Cart
	 */
	private $cart;

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

	/**
	 * @param modelCart $cart 
	 */
	public function __construct(\model\Cart $cart, \view\ProductList $productListView) {
		$this->cart = $cart;
		$this->productListView = $productListView;

		assert(isset($_SESSION));
	}

	public function addBuySuccessMessage() {
		$_SESSION["cartSuccessMessage"] = true;
	}

	//@todo duplication!!! 
	ublic function addRemoveSuccessMessage() {
		$_SESSION["cartRemoveMessage"] = true;
	}

	/**
	 * Creates a HTML representation of the cart
	 * @return String HTML 
	 */
	public function getCartHTML() {
		$productLines = $this->cart->getProductLines();
		$sum = $this->cart->getSumSEK();
		$html = "<ul>";

		

		foreach ($productLines as $productLine) {
			$product = $productLine->getProduct();
			$name = $product->getName();
			$costSEK = $product->getCostSEK();
			$amount = $productLine->getAmount();
			$totalSEK = $productLine->getTotalSEK();

			
			$linkHTML = $this->productListView->getBuyProductLink($product, "+");
			$removeLink = $this->productListView->getRemoveProductLink($product, "-");
			$buttons = "[$linkHTML][$removeLink]";
			
			$html .= "<li>$name $amount x $costSEK = $totalSEK SEK $buttons</li>";

		}
		$html .= "</ul>";

		if (isset($_SESSION["cartSuccessMessage"])) {
			$html .= "Grattis till ditt köp, kommer göra dig gott!</br>";
			unset($_SESSION["cartSuccessMessage"]);
		}

		return "<h2>Cart</h2> $html Summa : $sum kr";
	}
}