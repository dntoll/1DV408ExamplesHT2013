<?php

namespace View;


/**
 * Class RequestView
 */
class RequestView {
	
	/**
	 * Get IP adress of visiting 
	 */
	public function getIpRemoteAdress() {
		return $_SERVER["REMOTE_ADDR"];
	}
}
