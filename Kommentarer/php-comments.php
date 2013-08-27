<?php

//kommentar på en rad

#kommentar på en rad

/* kommentar
   på flera rader
*/

/**
* Ett exempel på kommentarer
* http://www.phpdoc.org/
*/
class Exempel {

	/**
	* @param integer 
	* @return integer ett nummer som är id + 3
	*/
	public function enMetod($id) {
		return $id + 3;
	}
}