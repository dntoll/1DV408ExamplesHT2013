<?php

class PubSecurity {
	
	/**
	* @param integer $age age in years
	* @return boolean
	*/
	public function isOk($age) {
		if ($age >= 18) {
			return true;
		} else {
			return false;
		}
	}
	
}