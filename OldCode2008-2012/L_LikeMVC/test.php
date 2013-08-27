<?php
session_start();
require_once('LikeView.php');
require_once('LikeModel.php');
require_once('..\Common\PageView.php');

//TODO: Accumulate a HTML String and use PageView
$html = "";
$html .= "<h2>Test av LikeView</h2>";
$lw = new LikeView();

$html .= "<h3>Test av LikeView you like...</h3><hr/>";
$html .= $lw->doOutput(5, true, "Messagelocation");

$html .= "<h3><hr/>Test av LikeView like är inte satt</h3><hr/>";

$html .= $lw->doOutput(5, false, "no message");

$html .= "<hr/><h2>Test av LikeModel</h2>";
 

if (LikeModel::test() == false) {
	$html .= "<br/>testet av LikeModel misslyckas<hr/>";
} else {
	$html .= "<br/>testet av LikeModel lyckades<hr/>";
}

$pageView = new \Common\PageView();
		
		
echo $pageView->GetHTMLPage("I like tests", $html);