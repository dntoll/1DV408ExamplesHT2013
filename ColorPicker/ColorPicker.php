<?php

namespace View;

require_once("VisualColor.php");

class ColorPicker {
	/**
	* @var String colorInput location in $_GET
	*/
	private static $colorInput = "colorSelected";

	/**
	* @var String message
	*/
	private $message = "";

	/**
	* @var \Model\palette palette
	*/
	private $palette;


	/**
	* @param \Model\Palette palette
	*/
	public function __construct(\Model\Palette $palette) {
		$this->palette = $palette;
	}

	/**
	* @return boolean
	*/
	public function userHasSelectedColor() {
		return isset($_GET[self::$colorInput]);
	}

	/**
	* @return \palette\Color
	* @throws Exception if input is invalid 
	*/
	public function getSelectedColor() {
		$colors = $this->palette->getAllColors();

		$index = $_GET[self::$colorInput];

		if (isset($colors[$index])) {
			return $colors[$index];
		}
		
		throw new \Exception("Input is manipulated");
	}


	public function showErrorMessage() {
		$this->message = "Could not select that color!";
	}

	/**
	* @return String HTML
	*/
	public function getHTML() {

		
		$selectedColor = $this->getSelectedColorHTML();
		$colorSelectionPalette = $this->getColorSelectionPaletteHTML();

		$ret = "
				<div>
					<h2>Selected Color</h2>
					$selectedColor
					$this->message
					<h2>Color Selection</h2>
					$colorSelectionPalette
				</div>";


		return $ret;
	}

	/**
	* @return String HTML
	*/
	private function getSelectedColorHTML() {
		try {
			$color = $this->palette->getSelectedColor();
			$visualColor = new VisualColor($color);

			return $visualColor->getColorHTML();
		} catch (\Exception $e) {
			return "no color selected";
		}
	}

	/**
	* Creates a 2D palette from a one dimensional array
	* Right now quite badly represented as "<a>" links with absolute CSS positioning
	* that does not scale well
	* @return String HTML
	*/
	private function getColorSelectionPaletteHTML() {
		$ret = "";
		$n = $this->palette->numberOfVariations; //short name
		$colors = $this->palette->getAllColors();

		foreach($colors as $index => $color) {
			

			$size = 400/sqrt(sizeof($colors)); //pixels
			//position link
			$x = $size * intval($index / $n) + 20;
			$y = $size * intval($index % $n) + 300;

			$vc = new VisualColor($color);
			$inlineColorStyle = $vc->getColorCSS($size, $x, $y);

			$ret .= "<a 
						style='$inlineColorStyle' 
						href='?" . self::$colorInput . "=$index'>
					</a>
					";
		}

		return $ret;
	}

	


}