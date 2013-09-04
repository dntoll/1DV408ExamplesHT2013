<?php

require_once("Book.php");
//Testcase
$book = new model\Book("Daniel", "PHP unlimited", "123456");
$bookSame = new model\Book("Daniel", "PHP unlimited", "123456");
$bookOther = new model\Book("Daniel", "PHP unlimited 2", "123457");
 
assert($book->isSame($bookSame) == true);
assert($book->isSame($bookOther) == false);
