<?php

require_once('LikeModel.php');
require_once('LikeView.php');


class LikeController {
	/**
	 * hantera en knapptryckning
	 * visa en like knapp
	 * visa hur många likes
	 * 
	 * 
	 * @return String HTML
	 */
	public function doControll() {
		$likeView = new LikeView();
		$likeModel = new LikeModel();
		
		//Handle input and collect messages
		$message = LikeView::NO_MESSAGE;
		if($likeView->didUserLike()) {
			$likeModel->userDoLike();
			//TODO: This message should be abstract here (const)
			//and translated in view...
			$message = LikeView::USER_DID_LIKE;
		}
		
		//Collect possibly changed state
		$likes = $likeModel->getNumberOfLikes();
		$userHasLiked = $likeModel->userHasLiked();
		
		//Create output and return
		return $likeView->doOutput($likes, $userHasLiked, $message);
	}
}