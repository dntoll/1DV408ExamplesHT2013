<?php

require_once("Book.php");
require_once("BookStore.php");
require_once("BookStoreView.php");
require_once("AddBookController.php");


$mysqli = new \mysqli("localhost", "root", "", "BookStore");

$bookDal = new BookDAL($mysqli);

$bookStore = new \model\BookStore($bookDal);

$controller = new \controller\AddBookController($bookStore);

$mysqli->close();

echo $controller->addBook();