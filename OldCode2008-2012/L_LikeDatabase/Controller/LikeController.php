<?php

namespace Controller;

require_once('/Model/LikeModel.php');
require_once('/View/ViewInterface.php');
require_once('/View/RequestView.php');




class LikeController {
	/**
	 * hantera en knapptryckning
	 * visa en like knapp
	 * visa hur många likes
	 * 
	 * 
	 * @return String HTML
	 */
	public function doControll(\Model\Database $db, \View\ViewInterface $likeView) {
		$rview = new \View\RequestView();
		
		$likeModel = new \Model\LikeModel($db);
		
		//Handle input and collect messages
		$message = \View\ViewInterface::NO_MESSAGE;
		if($likeView->didUserLike()) {
			if ($likeModel->userDoLike( $likeView->userHasLiked() , $rview->getIpRemoteAdress())) {
				$message = \View\ViewInterface::USER_DID_LIKE;
				$likeView->userDoLike();	
			} else {
				
			}
			
		}
		
		//Collect possibly changed state
		$likes = $likeModel->getNumberOfLikes();
		$userHasLiked = $likeView->userHasLiked();
		
		//Create output and return
		return $likeView->doOutput($likes, $userHasLiked, $message);
	}
}