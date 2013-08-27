<?php

  require_once("echoBr.php");
  
  class DatabaseAccess {
    private $m_mysqli = NULL;
    
    const table_name = "temp";
    
    public function Connect($a_host, $a_user, $a_password, $a_database) {
		echoBr("Connect to DB");
	      
		  
		//http://www.php.net/manual/en/mysqli.construct.php
		//http://www.php.net/manual/en/class.mysqli.php
		$this->m_mysqli = new mysqli($a_host, $a_user, $a_password, $a_database);
		  
		//Note charset should be set before any queries...
		$this->m_mysqli->set_charset("utf8");
      
		// check connection
		if ($this->m_mysqli->connect_errno) {
		    echoBr("Connect failed: $this->m_mysqli->connect_error");
		    return false;
		}
		return true;
	}
    
    public function Close() {
		echoBr("Close Connection");
		//http://www.php.net/manual/en/mysqli.close.php
		$this->m_mysqli->close();
    }
    
    /**
     * Note this one is sensitive to SQL-Injections and should only be used safely 
	 * (no input from user or "real_eascape_string")
     * 
     */
    public function RunQuery($sql) {
      //http://www.php.net/manual/en/mysqli.query.php
      if ($this->m_mysqli->query($sql) === FALSE) {
          echoBr("'$sql' failed " . $this->m_mysqli->error);
          return false;
      }
      return true;
    }
    
    public function CreateTables() {
      echoBr("Create table");
      $sql = "CREATE TABLE `test_db`.`" . DatabaseAccess::table_name . "` 
      		(
      			`pk` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      			`Name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
      		) 
      		ENGINE = MyISAM;";
      
      return $this->RunQuery($sql);
    }
    
    public function RemoveTables() {
      echoBr("Drop table");
      $sql = "DROP TABLE  `" . DatabaseAccess::table_name . "`";
      
      return $this->RunQuery($sql);
    }
	
	private function Insert($name) {
		$sql = "INSERT INTO " . DatabaseAccess::table_name . "(Name) VALUES(?)";
		
		//http://www.php.net/manual/en/mysqli.prepare.php
		//http://www.php.net/manual/en/class.mysqli-stmt.php
		$stmt = $this->m_mysqli->prepare($sql);
		
		if ($stmt === FALSE) {
			echoBr("prepare of '$sql' failed " . $this->m_mysqli->error);
			return false;
		}
		
		//http://www.php.net/manual/en/mysqli-stmt.bind-param.php
		if ($stmt->bind_param("s", $name) === FALSE) {
			echoBr("bind_param failed " . $stmt->error);
			$stmt->close();
			return false;
		}
		
		//http://www.php.net/manual/en/mysqli-stmt.execute.php
	    if ($stmt->execute()) {
	  		echoBr("InsertId $stmt->insert_id");
	  	} else {
	  		echoBr("execute " . $stmt->error);
	  		$stmt->close();
			return false;
	  	}
		
		//http://www.php.net/manual/en/mysqli-stmt.close.php
	    $stmt->close();
	    return true;
	}
    
    public function InsertRows() {
    	
		$people = array("Kalle", "Nisse", "Daniel", "Harry", "Mary", "Ada");
		
		foreach ($people as $name) {
			$this->Insert($name);
			echoBr("Inserted $name ");
		}
      
    }
    
	/**
	 * Fetches all posts and dumps the variables
	 */
    public function SelectAll() {
    	
		$sql = "SELECT pk, Name FROM ". DatabaseAccess::table_name;
		
		//http://www.php.net/manual/en/mysqli.prepare.php
		//http://www.php.net/manual/en/class.mysqli-stmt.php
		$stmt = $this->m_mysqli->prepare($sql);
      	if ($stmt === FALSE) {
			echoBr("prepare of '$sql' failed " . $this->m_mysqli->error);
			return false;
		}
		
		if ($stmt->execute()) {
		
		
			//Get result as a result-set 
			//http://php.net/manual/en/mysqli-stmt.get-result.php
			//http://www.php.net/manual/en/class.mysqli-result.php
			$result = $stmt->get_result();
			
			//http://www.php.net/manual/en/mysqli-result.fetch-array.php
			while ($row = $result->fetch_array(MYSQLI_NUM))
	        {
	         	//http://se.php.net/manual/en/function.var-dump.php
	           	var_dump($row);
	        }
			
			
			//Bind result
			/*$stmt->bind_result($pk, $name);
			while ($stmt->fetch()) {
		        echoBr("Fetched $pk, $name");
		    }*/
		    
			//third way is fetch_object as shown in DBConnection...
		}
	    $stmt->close();
    }

  }

