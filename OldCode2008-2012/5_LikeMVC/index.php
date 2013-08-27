<?php
  	session_start();
  
  	require_once("LikeView.php");
	require_once("LikeController.php");
	require_once("../Common/PageView.php");
	
	$xhtml = "";
	
	
	$likeController = new LikeController();
	$xhtml .= "Interaktivt test av LikeController<br/>";
	$xhtml .= $likeController->DoControll();
	/*	$xhtml .= "<br/>";
	  $view = new LikeView();
		$xhtml .= "Testfall där 4 gillar något<br/>";
		$xhtml .= $view->CreateLikeButton(4);
		$xhtml .= "<br/>";
		$xhtml .= "Testfall där 0 gillar något<br/>";
		$xhtml .= $view->CreateLikeButton(0);
		*/
	
	$pageView = new Common\PageView();
	echo $pageView->GetXHTML10StrictPage("Test", $xhtml);
	
	
