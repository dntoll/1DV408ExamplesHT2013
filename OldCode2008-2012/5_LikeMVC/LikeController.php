<?php

	require_once("LikeModel.php");

    class LikeController {
    	
		/**
		 * @return string XHTML
		 */
		public function DoControll() {
			$likeView = new LikeView();
			$model = new LikeModel();
			
			$userPressedLikeOK = false; 
			
			//Hämta indata från användaren
			if ($likeView->DidUserPressLike() == true) {
				$userPressedLikeOK = $model->UserLikes();
			}
			
			//Hämta data från modellen
			$likes = $model->GetNumberOfLikes();
			
			//Generera utdata
			$xhtml = $likeView->CreateLikeButton($likes);
			return "$xhtml";
		}
		
  }
