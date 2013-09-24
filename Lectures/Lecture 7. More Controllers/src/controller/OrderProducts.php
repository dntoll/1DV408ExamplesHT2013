<?php

namespace controller;

class OrderProducts {

	public function __construct() {

	}

	public function createOrder() {
		//handle input
		if ($this->view->hasAdress()) {
			$adress = $this->view->getAdress();

			$this->order->setAdress($adress);
		}
		if ($this->order->hasAdress() && 
			$this->view->userCompletesOrder()) {
			$orderCatalog->add($this->order);
			$this->cart->removeAllItems();

			$this->navigationView->goToReceipt();
		}

		$cartHTML = $this->cartView->getCartHTML();
		$adressFormHTML = $this->view->getAdressForm();
		$completeOrder = $this->view->getCompleteOrderButton();
		//create output show cart and adress-form
		return "$cartHTML $adressFormHTML $completeOrder";
	}
}