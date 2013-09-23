<?php

require_once("model/Book.php");
require_once("model/BookStore.php");
require_once("view/BookStoreView.php");
require_once("controller/AddBookController.php");
require_once("model/BookDAL.php");

$mysqli = new \mysqli("localhost", "root", "", "BookStore");

$bookStore = new \model\BookStore($mysqli);

$controller = new \controller\AddBookController($bookStore);

$mysqli->close();

echo $controller->addBook();