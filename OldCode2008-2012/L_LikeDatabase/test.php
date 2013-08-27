<?php
session_start();


require_once('View/LikeView.php');
require_once('Model/LikeModel.php');

require_once('Model/Database.php');
require_once('../Common\PageView.php');
require_once("Model/DBConfig.php");
require_once("Model/ProductCatalog.php");
require_once("Model/Product.php");

//TODO: Accumulate a HTML String and use PageView
$html = "";


$html .= "<hr/><h2>Test av ProductCatalog</h2>";
$db = new Model\Database();
$dbConfig = new Model\DBConfig();
$dbConfig->m_db = "testLikeDB";
$db->Connect($dbConfig);

if (Model\ProductCatalog::test($db) == false) {
	echo "Model\ProductCatalog test failed";
}

$db->Close();

$dbConfig = new Model\DBConfig();
$html .= "<hr/><h2>Test av Database</h2>";
if (Model\Database::test($dbConfig) == false) {
	$html .= "<br/>testet av Database misslyckas<hr/>";
} else {
	$html .= "<br/>testet av Database lyckades<hr/>";
}

$html .= "<hr/><h2>Test av LikeModel</h2>";
$db = new Model\Database();
$db->Connect($dbConfig);

if (Model\LikeModel::test($db) == false) {
	$html .= "<br/>testet av LikeModel misslyckas<hr/>";
} else {
	$html .= "<br/>testet av LikeModel lyckades<hr/>";
}
$db->Close();


$html .= "<h2>Test av LikeView</h2>";
$lw = new View\LikeView();

$html .= "<h3>Test av LikeView you like...</h3><hr/>";
$html .= $lw->doOutput(5, true, "Messagelocation");

$html .= "<h3><hr/>Test av LikeView like är inte satt</h3><hr/>";

$html .= $lw->doOutput(5, false, "no message");


 



$pageView = new \Common\PageView();
		
		
echo $pageView->GetHTMLPage("I like tests", $html);