<?php

namespace Model;

class Color {

	/**
	* @var float
	*/
	public $red;
	public $green;
	public $blue;

	/**
	* @param float red   [0.0-1.0]
	* @param float green [0.0-1.0]
	* @param float blue  [0.0-1.0]
	*/
	public function __construct($red, $green, $blue) {

		assert($red   >= 0.0 && $red   <= 1.0);
		assert($green >= 0.0 && $green <= 1.0);
		assert($blue  >= 0.0 && $blue  <= 1.0);

		$this->red = $red;
		$this->green = $green;
		$this->blue = $blue;
	}

	
}