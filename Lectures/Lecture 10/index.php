<?php

require_once("/src/view/HTMLPage.php");
require_once("/src/view/ProductList.php");
require_once("/src/controller/BuyProducts.php");
require_once("/src/controller/Application.php");
require_once("/src/model/CartSaver.php");
require_once("/src/model/DatabaseProductList.php");

session_start();

/*$productList = new \model\ArrayProductList();
$productList->add(new \model\Product("Banana", "Banan", 5.5));
$productList->add(new \model\Product("Peaches", "Peach", 3.33));
$productList->add(new \model\Product("Apple", "Apple", 2.33));
*/

$mysqli = new \mysqli("127.0.0.1", "root", "", "HT2013");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$productList = new \model\DatabaseProductList($mysqli);


$application = new \controller\Application($productList);
$html = $application->doApplication();

$mysqli->close();


//assemble output
$pageView = new \view\HTMLPage();
echo $pageView->getPage("Buy Products now cheap", "<h1>Products</h1>\n $html");