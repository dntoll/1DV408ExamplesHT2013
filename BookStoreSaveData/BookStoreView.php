<?php

require_once("BookStore.php");


/**
* BookStoreView visualizes a BookStore in HTML
*/
class BookStoreView {

	/**
	* @var BookStore
	*/
	private $bookStore;

	/**
	* @param BookStore
	*/
	public function __construct(BookStore $store) {
		$this->bookStore = $store;
	}

	/**
	* @return String (HTML)
	*/
	public function getHTML() {
		$returnValue = "<h2>Book Store</h2>";

		$sortedBooks = $this->bookStore->getByAuthorsSorted();

		$returnValue .= "<ol>";
		
		foreach ($sortedBooks as $book) {
			$returnValue .= "<li>" . $this->getBookHTML($book) . " </li>";
		}
		$returnValue .= "</ol>";


		return $returnValue;
	}
	/**
	* @param Book
	* @return String (HTML)
	*/
	private function getBookHTML(Book $book) {
		return "
				<div>
					<h3>$book->title</h3>
					<p>Author: $book->author</p>
					<p>ISBN: $book->isbn</p>
				</div> \n";
	}

}


//TestCase
/*$bookUnlimited = new Book("Daniel Toll", "PHP Unlimited", "123456");
$bookUnlimited2 = new Book("Daniel Toll", "PHP Unlimited II", "123457");
$bookDuck = new Book("Arne Anka", "Duck Tales", "7654321");

$bookStore = new BookStore();

$bookStore->AddBook($bookUnlimited);
$bookStore->AddBook($bookUnlimited2);
$bookStore->AddBook($bookDuck);

$bookStoreView = new BookStoreView($bookStore);

echo $bookStoreView->getHTML();*/