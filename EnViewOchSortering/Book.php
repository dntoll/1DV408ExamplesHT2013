<?php

/**
* An example class with member variables
* http://www.phpdoc.org/
*/
class Book {

	/**
	* @var String
	*/
	public $author;

	/**
	* @var String
	*/
	public $title;

	/**
	* @var String
	*/
	public $isbn;

	/**
	* @param String author , Example "J.K. Rowling"
	* @param String title , Example "Harry Potter and the Philosopher's Stone"
	* @param String isbn , Example "9788478888566"
	*/
	public function __construct($author, $title, $isbn) {
		$this->author = $author;
		$this->title = $title;
		$this->isbn = $isbn;

	}

	/**
	* @param Book other book to compare to
	* @return boolean return true if the books are the same
	*/
	public function isSame(Book $other) {
		if($this->author != $other->author) { 
			return false;
		}

		if($this->title != $other->title) { 
			return false;
		}

		if($this->isbn != $other->isbn) { 
			return false;
		}

		return true;
	}

	/**
	* @param Book a
	* @param Book b
	* @return int return 1 if  a > b
	*             return 0 if  a = b
	* 			  return -1 if a < b
	*/
	public static function compareByAuthor($a, $b) {

		//http://se1.php.net/usort# Example #3
 		$al = strtolower($a->author);
		$bl = strtolower($b->author);
		if ($al == $bl) {
			return 0;
		}
		return ($al > $bl) ? +1 : -1;
	}
}

//Testcase
/*$book = new Book("Daniel", "PHP unlimited", "123456");
$bookSame = new Book("Daniel", "PHP unlimited", "123456");
$bookOther = new Book("Daniel", "PHP unlimited 2", "123457");
 
assert($book->isSame($bookSame) == true);
assert($book->isSame($bookOther) == false);*/
