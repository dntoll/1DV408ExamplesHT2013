<?php

class BookView {
	private static $AuthorName = "BookView::AuthorName";
	private static $TitleName = "BookView::TitleName";
	private static $ISBNName = "BookView::ISBNName";
	private static $addBook = "addBook";

	private $message = "";

	/**
	* @return boolean true if user wants to add a book
	*/
	public function userWantsToAddBook() {
		if (isset($_GET[self::$addBook])) 
			return true;
		return false;
	}

	/**
	* @return String HTML
	*/
	public function getHTML() {
		//previous input
		
		$author = $this->getCleanInput(self::$AuthorName);
		$title = $this->getCleanInput(self::$TitleName);
		$isbn = $this->getCleanInput(self::$ISBNName);
		
		return "

			<div>
				<form action='?" . self::$addBook . "' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Add a new book</legend>
					<label for='AuthorID' >Author :</label>
					<input type='text' name='". self::$AuthorName ."' id='AuthorID' value='$author' />
					<label for='TitleID' >Title :</label>
					<input type='text' name='". self::$TitleName ."' id='TitleID' value='$title' />
					<label for='ISBNID' >ISBN :</label>
					<input type='text' name='". self::$ISBNName ."' id='ISBNID' value='$isbn' />
					<input type='submit' value='Add Book'/>
					$this->message
				</fieldset>

				</form>
			</div>";
	}

	/**
	* @return Book 
	* @throws Exception if something is wrong
	*/
	public function getNewBook() {
		$author = $this->getCleanInput(self::$AuthorName);
		$title = $this->getCleanInput(self::$TitleName);
		$isbn = $this->getCleanInput(self::$ISBNName);

		try {
			return new Book($author, $title, $isbn);
		} catch (Exception $e) {
			$this->message = "All fields need to be set";
			throw $e;
		}
	}

	public function bookAddedSuccess() {
		$this->message = "The book was successfully added...";
	}

	public function showThisBookExists() {
		$this->message = "The book already exists in library...";
	}

	

	/**
	* @param String input
	* @return String input - tags - trim
	* @throws Exception if something is wrong or input does not exist
	*/
	private function getCleanInput($inputName) {
		if (isset($_POST[$inputName]) == false) {
			return "";
		}
		
		return $this->sanitize($_POST[$inputName]);
	}

	/**
	* @param String input
	* @return String input - tags - trim
	*/
	private function sanitize($input) {
		$temp = trim($input);
		return filter_var($temp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	}
}