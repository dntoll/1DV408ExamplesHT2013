<?php

namespace Shop\Model;
require_once("./Model/Product.php");

require_once("./Model/IProductHandler.php");


/**
 * Klassen realiserar IProductHandler och har funktionalitet för att hämta produkter ur databasen
 * 
 */
class ProductHandlerWithDB implements IProductHandler {
	
	
	private $m_dbConnection = NULL; //\Common\DBConnection
	
	//Tabellnamn
	private $m_productTableName = "Product";
	
	//Hårdkodade kategorier
	private $m_categories = array("TV", 
                                  "Computers");
	
	
	public function __construct(\Common\DBConnection $a_connection, $tablePrefix) {
		$this->m_dbConnection = $a_connection;
		
		//Skapa tabellnamn mha prefix
		$this->m_productTableName = $tablePrefix . $this->m_productTableName;
	}
	
	/* SQL-kod för tabellen product
	 * CREATE TABLE  `L6Shop`.`Product` (
		`pk` INT NOT NULL AUTO_INCREMENT,
		`m_title` VARCHAR( 255 ) NOT NULL ,
		`m_description` VARCHAR( 255 ) NOT NULL ,
		`m_price` INT NOT NULL ,
		`m_category` INT NOT NULL ,
			PRIMARY KEY (  `pk` ) ,
			INDEX (  `m_category` )
		) ENGINE = MYISAM ;
	 * 
	 */
	
	/**
	 * @return array category strings indexed by categoryid
	 */
	public function GetCategories() {
		return $this->m_categories;
	}
	
	/**
    * @return array of Product objects indexed by id
    */	
	public function GetAllProducts() {
		$ret = array();
		
		$sql = "SELECT * FROM $this->m_productTableName";
		
		$stmt = $this->m_dbConnection->Prepare($sql);
		
		return $this->RunAndFetchObjects($stmt);	
	}
	
	/**
    * @return Product or NULL
    */
	public function GetProductById($a_id) {
				
		$sql = "SELECT * FROM $this->m_productTableName WHERE pk = ?";
		
		$stmt = $this->m_dbConnection->Prepare($sql);
		
		$stmt->bind_param("i", $a_id);
		
		$arr = $this->RunAndFetchObjects($stmt);
		
		//hämta bara ut objektet ifall det finns RunAndFetchObjects returnerar en array
		if (count($arr) == 1) { //har vi en produkt
			return $arr[$a_id];
		} else {
			return NULL;
		}
	}
	/**
    * @return array of Product objects indexed by id
    */	
	public function GetProductsByCategory($a_id) {
		
		
		$sql = "SELECT * FROM $this->m_productTableName WHERE m_category = ?";
		
		$stmt = $this->m_dbConnection->Prepare($sql);
		
		$stmt->bind_param("i", $a_id);
		
		return $this->RunAndFetchObjects($stmt);		
	}
	
	/**
	 * @return array of Shop\Model\Product instances with pk as key
	 */
	private function RunAndFetchObjects(\mysqli_stmt $a_stmt) {
		//Hämta en array av "\Shop\Model\Product" objekt indexerade av pk 
		return $this->m_dbConnection->RunAndFetchObjects($a_stmt, "\Shop\Model\Product", "pk");
	}
}
