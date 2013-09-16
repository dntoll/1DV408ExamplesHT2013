<?php

namespace Model;

require_once("Color.php");
require_once("SessionColorPersistor.php");

class Palette {
	/**
	* @var integer numberOfVariations
	*/
	public $numberOfVariations = 0;
	
	/**
	* @var array of Color objects, colors
	*/
	private $colors = array();

	/**
	 * @param int $numberOfVariations example: 8 
	 * @param SessionColorPersistor $persistance       
	 */
	public function __construct($numberOfVariations, SessionColorPersistor $persistance) {
		$this->numberOfVariations = $numberOfVariations;
		$this->colorPersistance = $persistance;
		$this->createPalette();
	}

	/**
	* @return array of Color objects, colors
	*/
	public function getAllColors() {
		return $this->colors;
	}

	/**
	* @return Color 
	*/
	public function getSelectedColor() {
		return $this->colorPersistance->load();
	}

	/**
	* @todo: restrict to colors in palette
	* @param Color selection
	*/
	public function setSelectedColor(Color $selection) {
		$this->colorPersistance->save($selection);
	}

	/**
	* Create a palette with a variation of colors
	*/
	private function createPalette() {
		//how much color between 0.0 and 1.0 is every step?
		$stepPerVariation = 1.0 /($this->numberOfVariations - 1);

		//blue is held constant
		$b = 1;

		//create all variations of red and green
		for ($r = 0; $r < $this->numberOfVariations; $r++) {
			for ($g = 0; $g < $this->numberOfVariations; $g++) {
				$this->colors[] = new Color($r * $stepPerVariation, 
											$g * $stepPerVariation, 
											$b * $stepPerVariation);
			}
		}
	}
}