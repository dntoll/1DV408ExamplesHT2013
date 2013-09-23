<?php

namespace model;

require_once("Book.php");

/*
* Data Acess Layer (DAL) for Books
*/
class BookDAL {
	private static $tableName = "book";

	/**
	* @var mysqli 
	*/
	private $mysqli;

	/**
	* @param mysqli  http://www.php.net/manual/en/book.mysqli.php
	*/
	public function __construct(\mysqli $mysqli) {
		$this->mysqli = $mysqli;
	}

	/**
	* @throws Exception on error
	*/
	public function createTable() {
      	$sql = "CREATE TABLE `" . self::$tableName . "` 
      		(
      			`pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      			`author` VARCHAR(255),
      			`title` VARCHAR(255),
      			`isbn` VARCHAR(255)
      		)
      		ENGINE = MyISAM;";
      
      if ($this->mysqli->query($sql) === FALSE) {
          throw new \Exception("'$sql' failed " . $this->mysqli->error);
      }
    }

    /**
    * @param Book the book to insert
    * @throws Exception if something goes wrong.
    */
    public function insertBook(Book $book) {
		$sql = "INSERT INTO " . self::$tableName . " 
			(
				author, 
				title, 
				isbn
			) 
			VALUES(?, ?, ?)";

		//http://www.php.net/manual/en/mysqli-stmt.prepare.php
		$statement = $this->mysqli->prepare($sql);
		if ($statement === FALSE) {
			throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
		}

		//http://www.php.net/manual/en/mysqli-stmt.bind-param.php
		if ($statement->bind_param("sss", $book->author, 
										  $book->title, 
										  $book->isbn) === FALSE) {
			throw new \Exception("bind_param of $sql failed " . $statement->error);
		}

		//http://www.php.net/manual/en/mysqli-stmt.execute.php
		if ($statement->execute() === FALSE) {
			throw new \Exception("execute of $sql failed " . $statement->error);
		}

    }

	/**
    * @return array of Book objects
    */
    public function getAllBooks() {
    	$ret = array();

    	$sql = "SELECT 
    				author, 
					title, 
					isbn FROM " . self::$tableName . ";";

		$statement = $this->mysqli->prepare($sql);
		if ($statement === FALSE) {
			throw new \Exception("prepare of $sql failed " . $this->mysqli->error);
		}

		if ($statement->execute() === FALSE) {
			throw new \Exception("execute of $sql failed " . $statement->error);
		}

		$result = $statement->get_result();
			
		while ($object = $result->fetch_array(MYSQLI_ASSOC))
        {
        	$ret[] = new Book($object["author"], 
        					  $object["title"], 
        					  $object["isbn"]);
        }

        return $ret;
    }

}


//TestCase
/*
$mysqli = new mysqli("localhost", "root", "", "BookStore");

$bookDAL = new BookDAL($mysqli);
try {
	$bookDAL->createTable();
} catch (Exception $e) {
	//table might exist if we have done this before...
	echo $e;
}
$bookDAL->insertBook( new Book("Daniel Toll", "Inferno", "12345") );


$mysqli->close();
*/
