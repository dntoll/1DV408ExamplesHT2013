<?php

namespace view;

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
	* @param BookStore $store
	*/
	public function __construct(\model\BookStore $store) {
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
	private function getBookHTML(\model\Book $book) {
		return "
				<div>
					<h3>$book->title</h3>
					<p>Author: $book->author</p>
					<p>ISBN: $book->isbn</p>
				</div> \n";
	}

}

