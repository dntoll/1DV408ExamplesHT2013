<?php

namespace controller;

require_once("src/model/Order.php");

class OrderProducts {

	/**
	 * @var \view\OrderView
	 */
	private $orderView;

	/**
	 * @var \view\Cart
	 */
	private $cartView;

	public function __construct(\view\OrderView $orderView, 
								\view\Cart $cartView) {
		$this->orderView = $orderView;
		$this->cartView = $cartView;

		//@todo persistence?
		$this->order = new \model\Order();
	}

	public function createOrder() {
		//handle input
		if ($this->orderView->hasAdress()) {
			$adress = $this->orderView->getAdress();

			$this->order->setAdress($adress);
		}
		if ($this->order->hasAdress() && 
			$this->orderView->userCompletesOrder()) {
			$orderCatalog->add($this->order);
			$this->cart->removeAllItems();

			$this->navigationView->goToReceipt();
		}

		$cartHTML = $this->cartView->getFixedCartHTML();
		$adressFormHTML = $this->orderView->getAdressForm();
		$completeOrder = $this->orderView->getCompleteOrderButton();
		//create output show cart and adress-form
		return "$cartHTML $adressFormHTML $completeOrder";
	}

	
}