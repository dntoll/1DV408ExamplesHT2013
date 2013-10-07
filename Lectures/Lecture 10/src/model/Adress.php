<?php

namespace model;

class Adress {

	/**
	 * @var String 
	 */
	private $adress;

	public function __construct($adressString) {
		assert(is_string($adressString));

		if ($adressString == "") {
			throw new \Exception("Address cannot be empty");
		}
		

		$this->adress = $adressString;
	}
}