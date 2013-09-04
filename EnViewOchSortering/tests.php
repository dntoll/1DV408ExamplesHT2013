<?php

require_once("Book.php");
require_once("BookStore.php");
require_once("BookStoreView.php");

//Testcase
$book = new model\Book("Daniel", "PHP unlimited", "123456");
$bookSame = new model\Book("Daniel", "PHP unlimited", "123456");
$bookOther = new model\Book("Daniel", "PHP unlimited 2", "123457");
 
assert($book->isSame($bookSame) == true);
assert($book->isSame($bookOther) == false);

//Testcase
$store = new model\BookStore();
$bookUnlimited = new model\Book("Daniel", "PHP Unlimited", "123456");

$bookWasInStore = $store->AddBook($bookUnlimited);
assert($bookWasInStore);

//Add the same book again
$bookWasInStore = $store->AddBook($bookUnlimited);
assert(!$bookWasInStore);

$bookUnlimited = new model\Book("Daniel Toll", "PHP Unlimited", "123456");
$bookUnlimited2 = new model\Book("Daniel Toll", "PHP Unlimited II", "123457");
$bookDuck = new model\Book("Arne Anka", "Duck Tales", "7654321");

$bookStore = new model\BookStore();

$bookStore->AddBook($bookUnlimited);
$bookStore->AddBook($bookUnlimited2);
$bookStore->AddBook($bookDuck);

$bookStoreView = new view\BookStoreView($bookStore);

echo $bookStoreView->getHTML();