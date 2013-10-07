<?php

namespace model;

class Order {

	/**
	 * @var Adress
	 */
	private $adress;

	public function __construct(Adress $adress) {
		$this->adress = $adress;

	}
}