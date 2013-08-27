<?php
    
    
    class LikeModel {
    	private $SessionPosition = "LikeModelLikes";
		/**
		 * @return boolean if not pressed before
		 */
    	public function UserLikes() {
    		if (isset($_SESSION[$this->SessionPosition]) == false) {
    			$_SESSION[$this->SessionPosition] = 1;
    		} else {
    			$_SESSION[$this->SessionPosition] += 1;
    		}
    	}
		
		/**
		 * @return int antal tryckningar
		 */
		public function GetNumberOfLikes() {
			if (isset($_SESSION[$this->SessionPosition]) == true) {
    			return $_SESSION[$this->SessionPosition];
    		} else {
    			return 0;
    		}
		}
    }
