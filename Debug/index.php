<?php

require_once("DebugView.php");
require_once("FormView.php");

session_start();
setcookie("MyCookie", "Value");



$fview = new FormView();
$dview = new DebugView();

if ($fview->hasUserName()) {
	$userName = $fview->getUserName();

	$_SESSION["username"] = $userName->getUserName();
}


echo $fview->getHTML();
echo $dview->getDebugData();

