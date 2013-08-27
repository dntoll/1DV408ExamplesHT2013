<?php
    
namespace Shop\Model;

class ProductDAL {
	const table_name = "product";
	const class_name = "\Shop\Model\Product";
	private $m_connection;
	
	public function __construct(\DBConnection $connection) {
		$this->m_connection = $connection;
		
		//This is really slow and should be avoided... 
		if ($this->m_connection->TableExists(ProductDAL::table_name) == false) {
			$this->CreateTable();
		}
	}
	
	public function CreateTable() {
		
		/**
		 * public $m_title;
  		   public $m_desription;
 		  public $m_price;
  			 public $m_category;
		 */
      echoBr("Create table");
      $sql = "CREATE TABLE `" . ProductDAL::table_name . "` 
      		(
      			`pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      			`m_title` VARCHAR(255),
      			`m_description` VARCHAR(255),
      			`m_price` int,
      			`m_category` int
      		)
      		ENGINE = MyISAM;";
      
      return $this->m_connection->RunQuery($sql);
    }
	
	
	public function DropTable() {
		$this->m_connection->DropTable(ProductDAL::table_name);
	}
    
	public function GetAllInstances() {
		return $this->m_connection->GetAllInstances(ProductDAL::class_name, ProductDAL::table_name);
	}
	
	public function SelectBy($argument, $equals) {
		$sql = "SELECT * FROM " . ProductDAL::table_name . " WHERE ($argument = ?)";
		
		return $this->m_connection->RunPreparedSelectQuery(ProductDAL::class_name, $sql, "i", array(&$equals));
	}
	
	public function SelectByPk($pk) {
		$r = $this->SelectBy("pk", $pk);
		
		if (count($r) === 0) {
			return NULL;
		} else {
			return current($r); //get the first object in the array
		}
	}
	
	public function Update($pk, Product $a_instance) {
		$sql = "UPDATE " . ProductDAL::table_name . " SET m_title = ?, m_description = ?, m_price = ?, m_category = ? WHERE pk = ?";
		return $this->m_connection->RunPreparedQuery($sql, "ssii", array(&$a_instance->m_title, 
																		 &$a_instance->m_description, 
																		 &$a_instance->m_price,
																		 &$a_instance->m_category,
																		 &$pk) );
	}
	
	public function Insert(Product $a_instance) {
		$sql = "INSERT INTO " . ProductDAL::table_name . "(m_title, Second, Third) VALUES(?, ?, ?)";
		return $this->m_connection->RunPreparedQuery($sql, "ssiii", array(&$a_instance->m_title, 
																		 &$a_instance->m_description, 
																		 &$a_instance->m_price,
																		 &$a_instance->m_category,
																		 &$pk) );
	}
	
	public function Delete($pk) {
		$sql = "DELETE FROM " . ProductDAL::table_name . " WHERE pk = ?";
		$this->m_connection->RunPreparedQuery($sql, "i", array(&$pk) );
	}
}
