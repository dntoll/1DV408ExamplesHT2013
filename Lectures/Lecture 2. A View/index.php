<?php

require_once("/src/view/HTMLPage.php");
require_once("/src/view/ProductList.php");


$productListView = new \view\ProductList();
$productList = new \model\ProductList();

$productList->add(new \model\Product("Banana", "Banan"));
$productList->add(new \model\Product("Peaches", "Peach"));

$productListHTML = $productListView->getProductList($productList);



$pageView = new \view\HTMLPage();

echo $pageView->getPage("Buy Products now cheap", "<h1>Products</h1>\n $productListHTML");