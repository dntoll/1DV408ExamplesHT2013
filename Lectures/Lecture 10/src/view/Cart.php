<?php

namespace view;

require_once("src/model/PersistantMessage.php");

class Cart {

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

	/**
	 * @var \model\PersistantMessage
	 */
	private $persistantMessage;

	/**
	 * @param viewProductList $productListView [description]
	 * @param viewNavigation  $navigationView  [description]
	 */
	public function __construct(\view\ProductList $productListView,
								\view\Navigation $navigationView,
								\model\PersistantMessage $persistantMessage) {
		$this->productListView = $productListView;
		$this->navigationView = $navigationView;

		$this->persistantMessage = $persistantMessage;
		
	}

	
	public function setSuccessMessage() {

		if ($this->productListView->userBuysProduct()) {
			$this->persistantMessage->succededToAddProduct();
		} else {
			$this->persistantMessage->succededToRemoveProduct();
		}
	}

	
	/**
	 * @todo remove duplications from getCartHTML!
	 * Creates a HTML representation of the cart
	 * @return String HTML 
	 */
	public function getFixedCartHTML(\model\Cart $cart) {
		$productLines = $cart->getProductLines();
		$sum = $cart->getSumSEK();
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
		
		return "<h2>Cart</h2> $html Summa : $sum kr";
	}

	/**
	 * Creates a HTML representation of the cart
	 * @return String HTML 
	 */
	public function getCartHTML(\model\Cart $cart) {
		$productLines = $cart->getProductLines();
		$sum = $cart->getSumSEK();
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
		
		//todo encapsulate messages
		if ($this->persistantMessage->didBuyProduct()) {
			$html .= "Grattis till ditt köp, kommer göra dig gott!</br>";	
		} else if ($this->persistantMessage->didRemoveProduct()) { 
			$html .= "Du tog bort en produkt! </br>";
		}


		if ($cart->containsItems()) {
			$checkout = $this->navigationView->getCheckoutLink();
			
		} else {
			$checkout = "Inga produkter i varukorgen";
		}
		return "<h2>Cart</h2> $html Summa : $sum kr $checkout";
	}

	
}