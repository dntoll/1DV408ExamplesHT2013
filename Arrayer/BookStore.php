<?php

namespace model;

require_once("Book.php");

/**
* BookStore Contains a record of which books are available
* in a BookStore
*/
class BookStore {
	/**
	* @var array of Book objects
	*/
	private $books = array();

	/**
	* @param Book book The book to be added
	* @return boolean Return true if book was added, 
	*                        false if book already was in store...
	*/
	public function addBook(Book $book) {
		if ($this->isBookInStore($book))
			return false;

		//Add book to the end of the array
		$this->books[] = $book;

		return true;
	}

	/**
	* @return array of Book objects sorted by author
	*/
	public function getByAuthorsSorted() {
		//http://se1.php.net/usort
		$sortOk = usort($this->books, array("Book", "compareByAuthor") );

		assert($sortOk);

		return $this->books;
	}



	/**
	* @param Book book, book to be compared to Store
	* @return boolean true if book exists in store
	*/
	private function isBookInStore(Book $book) {

		var_dump(debug_backtrace());

		//isBookin store
		foreach ($this->books as $inStoreBook) {
			if ($inStoreBook->isSame($book)) {
				return true;
			}
		}
		return false;
	}
}

