<?php

namespace model;


abstract class Adress {
	abstract public function getStreet();
}

class NullAdress extends Adress {
	public function getStreet() {
		return "";
	}
}


//@todo change to Address
class ValidAdress extends Adress {

	/**
	 * @var String 
	 */
	private $adress;

	/**
	 * @throws  Exception If addressString is empty
	 * @param [type] $addressString [description]
	 */
	public function __construct($addressString) {
		assert(is_string($addressString));

		if ($addressString == "") {
			//@todo this must be catched
			throw new \Exception("Address cannot be empty");
		}
		

		$this->adress = $addressString;
	}

	public function getStreet() {
		return $this->adress;
	}
}