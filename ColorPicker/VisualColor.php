<?php

namespace View;

class VisualColor {

	/**
	 * @var \Model\Color $color
	 */
	private $color;

	/**
	 * @param ModelColor $color [description]
	 */
	public function __construct(\Model\Color $color) {
		$this->color = $color;
	}

	/**
	* @return String HTML
	*/
	public function getColorHTML() {
		$inlineColorStyle = $this->getColorCSSInternal();
		$inlineColorStyle .= "width : 100px;height : 100px;";
		return "<div style='$inlineColorStyle'></div> 
				<p>
					Red = ". $this->color->red.", Green = ".$this->color->green.", Blue = ".$this->color->blue."
				</p>";
	}

	/**
	* @return String CSS
	*/
	public function getColorCSS($size, $x, $y) {
		
		$inlineColorStyle = $this->getColorCSSInternal();
		$inlineColorStyle .= "width : " . $size . "px;height : " . $size . "px;";
		$inlineColorStyle .= "position:absolute;top:" . $y . "px;left:" . $x . "px;";
		return $inlineColorStyle;
	}

	/**
	* @param Color color the color to translate to CSS
	* @return String CSS
	*/
	private function getColorCSSInternal() {
		
		$r = intval($this->color->red * 255);
		$g = intval($this->color->green * 255);
		$b = intval($this->color->blue * 255);
		return "background-color:rgb($r,$g,$b);";
		
	}


}