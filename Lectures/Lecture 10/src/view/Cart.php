<?php

namespace view;



class Cart {

	/**
	 * Location in $_SESSION to hold last message 
	 * @var string
	 */
	private static $messageHolder = "view::Cart::ActionSuccess";
		
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
	

	/**
	 * @var \view\ProductList
	 */
	private $productListView;

	/**
	 * @param viewProductList $productListView [description]
	 * @param viewNavigation  $navigationView  [description]
	 */
	public function __construct(\view\ProductList $productListView,
								\view\Navigation $navigationView) {
		$this->productListView = $productListView;
		$this->navigationView = $navigationView;

		assert(isset($_SESSION));
	}

	
	public function setSuccessMessage() {

		if ($this->productListView->userBuysProduct()) {
			$_SESSION[self::$messageHolder] = self::$addProductSucceded;
		} else {
			$_SESSION[self::$messageHolder] = self::$removeProductSucceded;
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
		

		if (isset($_SESSION[self::$messageHolder])) {
			if ($_SESSION[self::$messageHolder] == self::$addProductSucceded) {
				$html .= "Grattis till ditt köp, kommer göra dig gott!</br>";	
			} else {
				$html .= "Du tog bort en produkt! </br>";
			}
			unset($_SESSION[self::$messageHolder]);
		}


		if ($cart->containsItems()) {
			$checkout = $this->navigationView->getCheckoutLink();
			
		} else {
			$checkout = "Inga produkter i varukorgen";
		}
		return "<h2>Cart</h2> $html Summa : $sum kr $checkout";
	}

	
}