<?php 

class LikeModel {
		
	/**
	 * Location in session where we store if a user has liked something or not.
	 */
	private $m_sessionLocation = "LikeModel::HasLiked";
	
	/**
	 * Filename for the file where we store the total number of likes
	 * shared by all the clients
	 */
	private $m_fileName = "likes.txt";
	
	/**
	 * Reads a common source for the number of likes
	 * @return integer 
	 */
	public function getNumberOfLikes() {
		//open a file for reading and get the filePointer
		$fp = fopen($this->m_fileName, "r");
		
		//Read the first row in the file
		$row = fgets($fp);
		
		//convert the string into number
		$ret = $row + 0;
		
		//close the file to free resources
		fclose($fp);
		
		
		return $ret;
	}
	
	/**
	 * @return boolean
	 */
	public function userHasLiked() {
		return isset($_SESSION[$this->m_sessionLocation]);
	}
	
	/**
	 * Called when a user likes something
	 *  
	 * @return boolean true if like was possible 
	 */
	public function userDoLike()
	{
		//make sure we cannot like twice
		if ($this->userHasLiked()) {
			return false;
		}
		//collect the old value
		$likes = $this->getNumberOfLikes();
		
		$likes++;
		
		//open the file for writing (truncate)
		$fp = fopen($this->m_fileName, "w");
		
		//write the new value as string
		fwrite($fp, "$likes");
		
		//free resources
		fclose($fp);
		
		//user has now liked
		$_SESSION[$this->m_sessionLocation] = true;
		
		return true;
	}
	
	/**
	 * Reset the Session from the test so we know.
	 */
	private function reset() {
		if($this->userHasLiked())
			unset($_SESSION[$this->m_sessionLocation]);
	}
	
	/**
	 * Chained test 
	 */
	public static function test() {
		
		//system under test
		$sut = new LikeModel();
		
		//Put ourself in known state (do not like)
		$sut->reset();
		
		//Collect the previous state
		$numLikesAtStart = $sut->getNumberOfLikes();
		
		//Check that we do not already like
		if ($sut->userHasLiked() == true) {
			echo "We liked stuff from start";
			return false;
		}
		
		//Like
		if ($sut->userDoLike() == false) {
			echo "userDoLike returned false";
			return false;
		}
		
		//Check so we now likes
		if ($sut->userHasLiked() == false) {
			echo "We did not like stuff after like";
			return false;
		}
		
		//Collect the new number of likes
		$numLikesAfterLike = $sut->getNumberOfLikes();
		//Make sure they are +1
		if ($numLikesAtStart +1 != $numLikesAfterLike) {
			echo "Number of likes was not updated...";
			return false;
		}
		
		//Like again, should fail
		if ($sut->userDoLike() == true) {
			echo "userDoLike returned true";
			return false;
		}
		
		//Read the number of likes again
		$numLikesAfterSecondLike = $sut->getNumberOfLikes();
		
		//Make sure it is the same
		if ($numLikesAfterLike != $numLikesAfterSecondLike) {
			echo "Number of likes was updated twice...";
			return false;
		}
		
		
		//Every test is ok
		return true;
	}
}