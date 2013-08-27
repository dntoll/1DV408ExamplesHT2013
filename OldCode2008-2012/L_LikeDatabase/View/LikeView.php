<?php

namespace View;

require_once('View/ViewInterface.php');

class LikeView implements ViewInterface {
	
	/**
	 * String location in $_GET
	 */
	private $m_getLikeLocation = "ILike";
	private $m_cookieLocation = "ILikeCookies";
	private $m_message = "";
	
	public function userHasLiked() {
		return isset($_COOKIE[$this->m_cookieLocation]);
	}
	
	
	/**
	 * confirm a like
	 */
	public function userDoLike() {
		setcookie($this->m_cookieLocation, true, time() + 30);
		$_COOKIE[$this->m_cookieLocation] = true;
		$this->m_message = "User liked something";
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
			
			//TODO: Like Products! NavigationView måste vara inblandad!
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
					<h1>LikeView</h1>
					Antalet likes är $likes
					
					$likeButton
					
					<br/>
					
					$messageHTML
					<br/>
					$this->m_message
				</div>";
	}
	
	
}