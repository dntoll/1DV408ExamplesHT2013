<?php



/**
 * abstrakt basklass för de olika vyerna
 */
abstract class SelectColorViewBase {
	
	const RED = 1;
  	const GREEN = 2;
	
	
	public abstract function GetUserselectedColor();
	
	public abstract function DoSelectionMenu();
	
	
}
