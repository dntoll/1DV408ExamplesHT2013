<?php

require_once("PageView.php");
require_once("ReloadCounter.php");

session_start();

$counter = ReloadCounter::getInstance();

$reloads = $counter->GetReloadCount();


//Create output
$view = new PageView("UTF-8");
$cssFile = "style.css";
$view->AddStyleSheet($cssFile);
$body = "<p>The page has been reloaded $reloads times, in this session</p>";
$title = "An example title";
$pageHTML = $view->GetXHTML10StrictPage($title, $body);
echo $pageHTML;
