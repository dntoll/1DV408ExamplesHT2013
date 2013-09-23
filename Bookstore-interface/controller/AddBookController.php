<?php

namespace controller;


require_once("view/BookStoreView.php");
require_once("view/BookView.php");

/**
* AddBookController handles the use case Add book
* Use-Case starts when user wants to add a book
* User presents Book title, author and ISBN number to system
* The system confirmes that the book has been added
* and shows all books in the store.
*/
class AddBookController {
	/**
	 * @var \view\BookStoreView
	 */
	private $bookStoreView;

	/**
	 * @var \view\BookView
	 */
	private $bookView;

	/**
	 * @var \model\BookStore
	 */
	private $bookStore;

	/**
	 * @param model\BookStore $bookStore 
	 */
	public function __construct(\model\BookStore $bookStore) {
		$this->bookStore = $bookStore;
		$this->bookStoreView = new \view\BookStoreView($this->bookStore);
		$this->bookView = new \view\BookView();
	}
	/**
	* @return String HTML
	*/
	public function addBook() {
		$this->handleInput();

		//Combine Output
		return $this->bookStoreView->getHTML() . $this->bookView->getHTML();
	}

	private function handleInput() {
		if ($this->bookView->userWantsToAddBook()) {
			try {
				$book = $this->bookView->getNewBook();

				if ($this->bookStore->addBook( $book ) == false) {
					$this->bookView->showThisBookExists();
				} else {
					$this->bookView->bookAddedSuccess();
				}
			} catch (\Exception $exception) {
				
			}
			
		}
	}
}

