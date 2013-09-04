<?php

require_once("BookStore.php");

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

