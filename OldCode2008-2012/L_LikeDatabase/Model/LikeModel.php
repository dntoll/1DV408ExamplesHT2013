<?php 

namespace Model;

class LikeModel {
		
	
	
	
	private $m_db = NULL;
	
	public function __construct(Database $db) {
		$this->m_db =$db;
	}
	
	/**
	 * Reads a common source for the number of likes
	 * @return integer 
	 */
	public function getNumberOfLikes() {
		$ret = $this->m_db->SelectOne("SELECT COUNT(*) FROM Likes");
		
		
		return $ret;
	}
	
	/**
	 * Called when a user likes something
	 * @param $userHasLiked boolean true if user allready likes
	 * @param $ipAdress of poster
	 * 
	 * @return boolean true if like was possible 
	 */
	public function userDoLike($userHasLiked, $ipAdress)
	{
		//make sure we cannot like twice
		if ($userHasLiked) {
			return false;
		}
		$timeStamp = time();
		
		//var_dump($_SERVER);
		
		//$ip = "145454wdf";
		//		
		$sql = "INSERT INTO Likes (ip, time) VALUES (?, ?)";
		
		$stmt = $this->m_db->Prepare($sql);
		
		$stmt->bind_param("si", $ipAdress, $timeStamp);
		
		$insertId = $this->m_db->RunInsertQuery($stmt);
		
		return true;
	}
	
		
	/**
	 * Chained test 
	 */
	public static function test(Database $db) {
		
		
		
		//system under test
		$sut = new LikeModel($db);
		
		//Collect the previous state
		$numLikesAtStart = $sut->getNumberOfLikes();
		
		
		//Like
		if ($sut->userDoLike(false, "192.168.0.1") == false) {
			echo "userDoLike returned false";
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
		if ($sut->userDoLike(true, "192.168.0.1") == true) {
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