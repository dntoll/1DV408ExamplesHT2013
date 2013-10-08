<?php

namespace controller;

require_once("src/model/Order.php");
require_once("src/model/OrderSessionSaver.php");
require_once("src/model/Adress.php");
require_once("src/model/OrderCatalog.php");

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
	private $pendingOrder = null;	

	/**
	 * @var \model\Order
	 */
	private $completedOrder = null;	

	

	/**
	 * @param view\OrderView $orderView [description]
	 * @param view\Cart      $cartView  [description]
	 */
	public function __construct(\view\OrderView $orderView, 
								\view\Cart $cartView,
								\model\Cart $cart,
								\view\Navigation $navigationView) {
		$this->orderView = $orderView;
		$this->cartView = $cartView;

		@todo pendingOrder and completedOrders? must be saved database?
		$this->orderSaver = new \model\OrderSessionSaver();
		if ($this->orderSaver->hasOrderSaved()) {
			$this->pendingOrder = $this->orderSaver->load();
		}

		$this->orderCatalog = new \model\OrderCatalog();
		$this->cart = $cart;

		$this->navigationView = $navigationView;

	}

	public function showReceipt() {
		$html = $this->orderView->showReceipt($this->completedOrder, $this->cartView);

		
		return $html;
	}

	public function createOrder(CartSwapper $cartSwapper) {
		//handle input
		if ($this->orderView->hasAdress()) {

			$adress = $this->orderView->getAdress();

			$this->pendingOrder = new \model\Order($adress, $this->cart);
			$this->orderSaver->save($this->pendingOrder);
		}

		
		if ($this->order != null && 
			$this->orderView->userCompletesOrder()) {

			$this->orderCatalog->add($this->pendingOrder);
			$cartSwapper->newCart();
			$this->completedOrder = $this->pendingOrder;
			$this->pendingOrder = null;

			$this->navigationView->goToReceipt();
		}

		if ($this->pendingOrder != null) {
			$adress = $this->pendingOrder->getAdress();
		} else {
			//@todo singleton
			$adress = new \model\NullAdress();
		}

		$cartHTML = $this->cartView->getFixedCartHTML($this->cart);
		$adressFormHTML = $this->orderView->getAdressForm($adress);
		$completeOrder = $this->orderView->getCompleteOrderButton();
		//create output show cart and adress-form
		return "$cartHTML $adressFormHTML $completeOrder";
	}

	
}