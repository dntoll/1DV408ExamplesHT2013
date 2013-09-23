<?php

namespace model;




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
	* @var BookDAL
	*/ 
	private $bookDAL;

	/**
	 * 
	 * @param mysqli $dbConnection A connected db
	 */
	public function __construct(\mysqli $dbConnection) {
		$this->bookDAL = new BookDAL($dbConnection);

		$this->books = $this->bookDAL->getAllBooks();
	}

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
		$this->bookDAL->insertBook($book);

		return true;
	}

	/**
	* @return array of Book objects sorted by author
	*/
	public function getByAuthorsSorted() {
		//http://se1.php.net/usort
		$sortOk = usort($this->books, array("\model\Book", "compareByAuthor") );

		assert($sortOk);

		return $this->books;
	}



	/**
	* @param Book book, book to be compared to Store
	* @return boolean true if book exists in store
	*/
	private function isBookInStore(Book $book) {
		//isBookin store
		foreach ($this->books as $inStoreBook) {
			if ($inStoreBook->isSame($book)) {
				return true;
			}
		}
		return false;
	}
}

