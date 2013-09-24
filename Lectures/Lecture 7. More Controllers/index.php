<?php

require_once("/src/view/HTMLPage.php");
require_once("/src/view/ProductList.php");
require_once("/src/controller/BuyProducts.php");
require_once("/src/controller/Application.php");
require_once("/src/model/CartSaver.php");

session_start();


$application = new \controller\Application();
$html = $application->doApplication();

//assemble output
$pageView = new \view\HTMLPage();
echo $pageView->getPage("Buy Products now cheap", "<h1>Products</h1>\n $html");