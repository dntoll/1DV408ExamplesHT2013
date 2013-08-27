<?php

require_once("BookStore.php");
require_once("BookStoreView.php");
require_once("BookView.php");

/**
* AddBookController handles the use case Add book
* Use-Case starts when user wants to add a book
* User presents Book title, author and ISBN number to system
* The system confirmes that the book has been added
* and shows all books in the store.
*/
class AddBookController {
	private $bookStoreView;
	private $bookView;

	private $bookStore;


	public function __construct(BookStore $bookStore) {
		$this->bookStore = $bookStore;
		$this->bookStoreView = new BookStoreView($this->bookStore);
		$this->bookView = new BookView();
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
			} catch (Exception $exception) {
				
			}
			
		}
	}
}



//testCase
$bookUnlimited = new Book("Daniel Toll", "PHP Unlimited", "123456");
$bookUnlimited2 = new Book("Daniel Toll", "PHP Unlimited II", "123457");
$bookDuck = new Book("Arne Anka", "Duck Tales", "7654321");

$bookStore = new BookStore();

$bookStore->AddBook($bookUnlimited);
$bookStore->AddBook($bookUnlimited2);
$bookStore->AddBook($bookDuck);

$controller = new AddBookController($bookStore);

echo $controller->addBook();