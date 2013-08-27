<?php

namespace View;

class OtherLikeView implements ViewInterface{
	/**
	 * String location in $_GET
	 */
	private $m_getLikeLocation = "ILike";
	private $m_cookieLocation = "ILikeCookies";
	
	public function userHasLiked() {
		return isset($_COOKIE[$this->m_cookieLocation]);
	}
	
	public function userDoLike() {
		setcookie($this->m_cookieLocation, true, time() + 30);
		$_COOKIE[$this->m_cookieLocation] = true;
	}
	
	/**
	 * Collect input 
	 * @return boolean 
	 */
	public function didUserLike() {
		return isset($_GET[$this->m_getLikeLocation]);
	}
	
	/**
	 * Generate HTML output 
	 * @param $likes, Number of likes
	 * @param $userHasLiked, boolean
	 * @param $message, CONST  NO_MESSAGE | USER_DID_LIKE
	 * @return String,  HTML
	 */
	public function doOutput($likes, $userHasLiked, $message) {
		
		if ($userHasLiked == false) {
			$likeButton = "<a href='?$this->m_getLikeLocation'>I Like!</a>";
		} else {
			$likeButton = "You like...";
		}
		$messageHTML ="";
		if ($message == self::NO_MESSAGE) {
			$messageHTML = "No event";
		} else {
			$messageHTML = "<h3>You pressed like, thank you! </h3>";
		}
		
		return "
				<div>
					<h1>Other LikeView</h1>
					Antalet likes är $likes
					
					$likeButton
					
					<br/>
					
					$messageHTML
				</div>";
	}
	
	
}