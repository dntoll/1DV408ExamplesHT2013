<?php

namespace View;

interface ViewInterface {
	const USER_DID_LIKE = 0;
	const NO_MESSAGE = 1;
	
	/**
	 * return boolean
	 */
	function userHasLiked();
	
	/**
	 * message to view that a user liked something
	 */
	function userDoLike();
	
	/**
	 * Collect input 
	 * @return boolean 
	 */
	function didUserLike();
	
	/**
	 * Generate HTML output 
	 * @param $likes, Number of likes
	 * @param $userHasLiked, boolean
	 * @param $message, CONST  NO_MESSAGE | USER_DID_LIKE
	 * @return String,  HTML
	 */
	function doOutput($likes, $userHasLiked, $message);
}
