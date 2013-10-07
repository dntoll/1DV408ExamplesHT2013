<?php

namespace controller;

require_once("src/model/Order.php");
require_once("src/model/OrderSessionSaver.php");
require_once("src/model/Adress.php");

class OrderProducts {

	/**
	 * @var \view\OrderView
	 */
	private $orderView;

	/**
	 * @var \view\Cart
	 */
	private $cartView;

	/**
	 * @var \model\Order
	 */
	private $order = null;	

	/**
	 * @param view\OrderView $orderView [description]
	 * @param view\Cart      $cartView  [description]
	 */
	public function __construct(\view\OrderView $orderView, 
								\view\Cart $cartView) {
		$this->orderView = $orderView;
		$this->cartView = $cartView;

		$this->orderSaver = new \model\OrderSessionSaver();
		if ($this->orderSaver->hasOrderSaved()) {
			$order = $this->orderSaver->load();
		}
	}

	public function createOrder() {
		//handle input
		if ($this->orderView->hasAdress()) {

			$adress = $this->orderView->getAdress();

			$this->order = new \model\Order($adress);
			$this->orderSaver->save($this->order);
			
		}

		
		if ($this->order != null && 
			$this->orderView->userCompletesOrder()) {
			$orderCatalog->add($this->order);
			$this->cart->removeAllItems();

			$this->navigationView->goToReceipt();
		}

		$cartHTML = $this->cartView->getFixedCartHTML();
		$adressFormHTML = $this->orderView->getAdressForm($this->order);
		$completeOrder = $this->orderView->getCompleteOrderButton();
		//create output show cart and adress-form
		return "$cartHTML $adressFormHTML $completeOrder";
	}

	
}