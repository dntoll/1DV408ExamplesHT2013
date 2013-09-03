<?php

namespace model;

class Product {

	/**
	 * @var String Example Ban26
	 */
	private $uniqueID;

	/**
	 * @var String Example Banana
	 */
	private $name;

	/**
	 * @param String $name   Product readable name
	 * @param String $unique id of product should be unique
	 */
	public function __construct($name, $unique) {
		$this->uniqueID = $unique;
		$this->name = $name;
	}

	/**
	 * @return String
	 */
	public function getUnique() {
		return $this->uniqueID;
	}

	/**
	 * @return String
	 */
	public function getName() {
		return $this->name;
	}	
}