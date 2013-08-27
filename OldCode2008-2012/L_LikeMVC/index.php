<?php

session_start();

require_once('LikeController.php');
require_once('..\Common\PageView.php');


class MasterController {
	public static function doControll() {
		//TODO: Show that this is a controller
		$likeController = new LikeController();
		
		$html = $likeController->doControll();
		
		//TODO: Use Common/PageView
		$pageView = new \Common\PageView();
		
		
		return $pageView->GetHTMLPage("I like titles", $html);
	}
	
}

echo MasterController::doControll();


 
