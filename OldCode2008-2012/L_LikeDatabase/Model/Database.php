<?php

namespace Model;

class Database {
	private $mysqli = NULL;
	
	public function Connect(DBConfig $config) {
		$this->mysqli = new \mysqli($config->m_host, 
							 $config->m_user, 
							 $config->m_pass, 
							 $config->m_db);

		
		if ($this->mysqli->connect_error) {
		    throw new \Exception($this->mysqli->connect_error);
		}
		
		$this->mysqli->set_charset("utf8");
		
		return true;
	}
	
	/**
	 * Select a single value from a query
	 * @param $sqlQuery String SQL query with one parameter output 
	 * Ex SELECT Count(*) FROM ...
	 * 
	 * @return 
	 */
	public function SelectOne($sqlQuery) {
		
		//http://php.net/manual/en/mysqli.prepare.php
		//http://php.net/manual/en/class.mysqli-stmt.php
		//TODO: anropa funktionen nedan istället DRY!
		$stmt = $this->mysqli->prepare($sqlQuery);
		
		if ($stmt === FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
		//execute the statement
		//http://php.net/manual/en/mysqli-stmt.execute.php
		if ($stmt->execute() == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		$ret = 0;
		
		//Bind the $ret parameter so when we call fetch it gets its value
		//http://php.net/manual/en/mysqli-stmt.bind-result.php
		if ($stmt->bind_result($ret) == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
		//http://php.net/manual/en/mysqli-stmt.fetch.php
		$stmt->fetch();
		
		$stmt->close();
		
		
		return $ret;
	}
	
	public function Select($sqlQuery) {
		
		//http://php.net/manual/en/mysqli.prepare.php
		//http://php.net/manual/en/class.mysqli-stmt.php
		
		//TODO: anropa funktionen nedan istället DRY!
		$stmt = $this->mysqli->prepare($sqlQuery);
		
		if ($stmt === FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
		//execute the statement
		//http://php.net/manual/en/mysqli-stmt.execute.php
		if ($stmt->execute() == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		$ret = 0;
		
		return $stmt;
	}
	
	/**
	 * Prepares query
	 * @param $sql String Sql query 
	 * @return mysqli_stmt 
	 */
	public function Prepare($sql) {
		$ret = $this->mysqli->prepare($sql);
		
		if ($ret == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
		return $ret;
		
	}
	
	/**
	 * @param $stmt mysqli_stmt 
	 * @return integer insert id  
	 */
	public function RunInsertQuery(\mysqli_stmt $stmt) {
			
			
		if ($stmt->execute() == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
		$ret = $stmt->insert_id;
		
		$stmt->close();
		
		return $ret;
	}
	
	public function Close() {
		return $this->mysqli->close();
	}

	public static function test(DBConfig $dbConfig) {
		$db = new Database();
		
		if ($db->Connect($dbConfig) == false) {
			echo "Database Connect failed";
			return false;
		}
		
		$numberOfPostBefore = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
		
		$stmt = $db->Prepare("INSERT INTO InsertTable VALUES (1)");
		$db->RunInsertQuery($stmt);
		
		$numberOfPostAfter = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
		
		if ($numberOfPostBefore +1 != $numberOfPostAfter) {
			echo "Prepare or RunInsertQuery failed";
			return false;
		}
		
		if ($db->SelectOne("SELECT COUNT(*) FROM NotEmpty") != 2) {
			echo "Database SelectOne failed";
			return false;
		}
		
		if ($db->Close() == false) {
			echo "Database Close failed";
			return false;
		}
		
		
		return true;
	}	
}
