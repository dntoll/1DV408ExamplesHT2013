<?php
    
    
    class LikeView {
    	private $likedButtonURL = "liked";
		/**
		 * 
		 * @return string XHTML string
		 */
		public function CreateLikeButton($likes) {
			if ($likes == 0) {
				return "<a href='?$this->likedButtonURL=true' >Like</a> Ingen gillar detta";
			}
			return "<a href='?$this->likedButtonURL=true' >Like</a> $likes har gillat den här tidigare";
		}
		
		/**
		 * @return boolean true if user klicked the link
		 */
		public function DidUserPressLike() {
			if ( isset($_GET[$this->likedButtonURL]) == true ) {
				return true;
			}
			return false;
		}
    }
