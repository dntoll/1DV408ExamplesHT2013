<?php

require_once("/src/view/ProductList.php");
require_once("/src/controller/BuyProducts.php");
require_once("/tests/ProductListStub.php");


$banana = new \model\Product("Banana", "Banan");
$productList = new \model\ProductList();
$productList->add($banana);
$productList->add(new \model\Product("Peaches", "Peach"));

$productStub = new ProductListStub();
$controller = new \controller\BuyProducts($productList, $productStub);



echo "<h1>Test 1. no input</h2>";
echo $controller->buyProducts();


echo "<h1>Test 2. buy existing product</h2>";
$productStub->setProductToBuy($banana);
echo $controller->buyProducts();

echo "<h1>Test 3. buy non existing product</h2>";
$productStub->setProductToBuy(new \model\Product("foo", "bar"));
echo $controller->buyProducts();

