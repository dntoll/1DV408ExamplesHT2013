<?php

require_once("/src/view/HTMLPage.php");
require_once("/src/view/ProductList.php");
require_once("/src/controller/BuyProducts.php");



$productList = new \model\ProductList();

$productList->add(new \model\Product("Banana", "Banan"));
$productList->add(new \model\Product("Peaches", "Peach"));

$productListController = new \controller\BuyProducts($productList);

$html = $productListController->buyProducts();

//



$pageView = new \view\HTMLPage();

echo $pageView->getPage("Buy Products now cheap", "<h1>Products</h1>\n $html");