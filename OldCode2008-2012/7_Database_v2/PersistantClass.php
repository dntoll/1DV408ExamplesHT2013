<?php

/**
 * This is just a normal class that must be saved or loaded to a DB could be a 
 * In the Shop example Product and perhaps Category should be persistant classes...
 * 
 * Since this class might hold business rules I usually dont litter it with DB functions, 
 * Instead I move this functionality to a Data Access Layer class "DAL"
 */
class PersistantClass {
	//Some member variables	
	//Note that they are public and that is NOT a good thing!
	public $First = "1 Etta";
	public $Second = "2 Tvåa";
	public $Third = "3 Trea";
}
