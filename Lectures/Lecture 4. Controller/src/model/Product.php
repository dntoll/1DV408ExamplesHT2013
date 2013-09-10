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
	 * @var float
	 */
	private $cost;

	/**
	 * @param String $name   Product readable name
	 * @param String $unique id of product should be unique
	 * @param float $cost SEK
	 */
	public function __construct($name, $unique, $cost) {
		assert(is_numeric($cost));

		$this->uniqueID = $unique;
		$this->name = $name;
		$this->cost = $cost;
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

	/**
	 * @return float SEK
	 */
	public function getCostSEK() {
		return $this->cost;
	}	
}