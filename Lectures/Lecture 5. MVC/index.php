<?php

require_once("/src/view/HTMLPage.php");
require_once("/src/view/ProductList.php");
require_once("/src/controller/BuyProducts.php");
require_once("/src/model/CartSaver.php");

session_start();

//Initiate model
$productList = new \model\ProductList();
$productList->add(new \model\Product("Banana", "Banan", 5.5));
$productList->add(new \model\Product("Peaches", "Peach", 3.33));

$cartSaver = new \model\CartSaver();

$cart = $cartSaver->load();

//run controller
$productListController = new \controller\BuyProducts($productList, $cart);
$html = $productListController->buyProducts();

$cartSaver->save($cart);

//assemble output
$pageView = new \view\HTMLPage();
echo $pageView->getPage("Buy Products now cheap", "<h1>Products</h1>\n $html");