<?php

namespace Controller;

require_once("Palette.php");
require_once("ColorPicker.php");


class SelectColor {
	/*
	* @var Palette model
	*/
	private $palette;

	/*
	* @var View view
	*/
	private $view;

	
	public function __construct(\Model\SessionColorPersistor $persistance) {
		$this->palette = new \Model\Palette(10, $persistance);
		$this->view = new \View\ColorPicker($this->palette);
	}


	/**
	* @return String [HTML]
	*/
	public function doSelectColor() {

		if ($this->view->userHasSelectedColor() ) {
			try {
				$color = $this->view->getSelectedColor();
				$result = $this->palette->setSelectedColor($color);
			} catch (\Exception $e) {
				$this->view->showErrorMessage();
			}
		}

		return $this->view->getHTML();
	}
}


