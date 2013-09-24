<?php

namespace view;



class Cart {

	private static $messageHolder = "view::Cart::ActionSuccess";
	private static $createOrder = "createOrder";
	
	//@todo document!
	private static $addProductSucceded = true;
	private static $removeProductSucceded = false;
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

	public function setSuccessMessage() {

		if ($this->productListView->userBuysProduct()) {
			$_SESSION[self::$messageHolder] = self::$addProductSucceded;
		} else {
			$_SESSION[self::$messageHolder] = self::$removeProductSucceded;
		}
		
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
		

		if (isset($_SESSION[self::$messageHolder])) {
			if ($_SESSION[self::$messageHolder] == self::$addProductSucceded) {
				$html .= "Grattis till ditt köp, kommer göra dig gott!</br>";	
			} else {
				$html .= "Du tog bort en produkt! </br>";
			}
			
			
			unset($_SESSION[self::$messageHolder]);
		}

		if ($this->cart->containsItems())
			$checkout = "<a href='?" . self::$createOrder. " '>Gå till kassan</a>";
		else 
			$checkout = "Inga produkter i varukorgen";
		return "<h2>Cart</h2> $html Summa : $sum kr $checkout";
	}

	public function userCreatesOrder() { 
		
		return isset($_GET[self::$createOrder]);
	}
}