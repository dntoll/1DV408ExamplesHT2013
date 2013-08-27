<?php

namespace Model;

require_once("Color.php");

class SessionColorPersistor {
	/**
	* @var String sessionLocation location in session where to store the selected color
	*/
	private $sessionLocation;

	/**
	* @param String sessionLocation location in $_SESSION to store the variable
	*/
	public function __construct($sessionLocation) {
		$this->sessionLocation = $sessionLocation;
		//make sure we have a session
		assert(isset($_SESSION));
	}

	/**
	* @return Color 
	*/
	public function load() {
		if (isset($_SESSION[$this->sessionLocation])) {
			return $_SESSION[$this->sessionLocation];
		}
		throw new \Exception("no color selected");
	}

	/**
	* @param Color selection
	*/
	public function save(Color $selection) {
		$_SESSION[$this->sessionLocation] = $selection;
	}
}