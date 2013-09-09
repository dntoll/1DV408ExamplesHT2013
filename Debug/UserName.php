<?php

namespace model;

class UserName {

	/**
	 * @var String
	 */
	private $userName;

	/**
	 * @param String $userName [description]
	 */
	public function __construct($userName) {
		if (strlen($userName) < 3 ) {
			throw new \Exception("UserName too short");
		}
		if (strlen($userName) > 10 ) {
			throw new \Exception("UserName too long");
		}

		if (strcmp($userName, rtrim($userName)) != 0)   {
			throw new \Exception("no spaces to the right");
		}

		$this->userName = $userName;
	}

	/**
	 * @return String
	 */
	public function getUserName() {
		return $this->userName;
	}
}