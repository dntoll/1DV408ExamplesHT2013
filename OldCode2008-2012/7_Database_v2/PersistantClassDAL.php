<?php
/**
 * Contains specific functions to save and load  PersistantClass to and from DB
 */
class PersistantClassDAL {
	
	const table_name = "PersistantClass";
	const class_name = "PersistantClass";
	private $m_connection;
	
	public function __construct(DBConnection $connection) {
		$this->m_connection = $connection;
	}
	
	public function CreateTable() {
      echoBr("Create table");
      $sql = "CREATE TABLE `" . PersistantClassDAL::table_name . "` 
      		(
      			`pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      			`First` VARCHAR(255),
      			`Second` VARCHAR(255),
      			`Third` VARCHAR(255)
      		)
      		ENGINE = MyISAM;";
      
      return $this->m_connection->RunQuery($sql);
    }
	
	
	public function DropTable() {
		$this->m_connection->DropTable(PersistantClassDAL::table_name);
	}
    
	public function GetAllInstances() {
		return $this->m_connection->GetAllInstances(PersistantClassDAL::class_name, PersistantClassDAL::table_name);
	}
	
	public function SelectBy($argument, $equals) {
		$sql = "SELECT * FROM " . PersistantClassDAL::table_name . " WHERE ($argument = ?)";
		return $this->m_connection->RunPreparedSelectQuery(PersistantClassDAL::class_name, $sql, "s", array(&$equals));
	}
	
	public function SelectByPk($pk) {
		$r = $this->SelectBy("pk", $pk);
		
		if (count($r) === 0) {
			return NULL;
		} else {
			return current($r);
		}
	}
	
	public function Update($pk, PersistantClass $a_instance) {
		$sql = "UPDATE " . PersistantClassDAL::table_name . " SET First = ?, Second = ?, Third = ? WHERE pk = ?";
		return $this->m_connection->RunPreparedQuery($sql, "sssi", array(&$a_instance->First, 
																		 &$a_instance->Second, 
																		 &$a_instance->Third,
																		 &$pk) );
	}
	
	public function Insert(PersistantClass $a_instance) {
		$sql = "INSERT INTO " . PersistantClassDAL::table_name . "(First, Second, Third) VALUES(?, ?, ?)";
		return $this->m_connection->RunPreparedQuery($sql, "sss", array(&$a_instance->First, 
																		&$a_instance->Second, 
																		&$a_instance->Third) );
	}
	
	public function Delete($pk) {
		$sql = "DELETE FROM " . PersistantClassDAL::table_name . " WHERE pk = ?";
		$this->m_connection->RunPreparedQuery($sql, "i", array(&$pk) );
	}
}