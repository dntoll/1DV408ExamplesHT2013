<?php
   
/**
 * Generic functions to save and load from DB
 * 
 * This class holds the connection and contains functions for manipulating a DB and tables
 * 
 */
class DBConnection {
	private $m_mysqli = NULL;
	
  
   	/**
   	 * Connect to database server
   	 * You should preferably only do this once per HTTP request
	 * 
	 * It is really not a good idea to keep password in a source file like this
	 * and 
	 * 
	 * TODO: move username, password, host and db to a settings.php file and let them be parameters here... 
   	 * 
   	 * @return bool true if successful
   	 */
	public function Connect() {
      echoBr("Connect to DB");
      $password = "";
      $this->m_mysqli = new mysqli("localhost", "root", $password, "test_db");
	  
	  
	  //Note charset should be set before any queries...
	  $this->m_mysqli->set_charset("utf8");
      
      // check connection
      if ($this->m_mysqli->connect_errno) {
          echoBr("Connect failed: $this->m_mysqli->connect_error");
          return false;
      }
      return true;
    }
	
    /**
   	 * Close the connection to the database server
   	 */
    public function Close() {
      	echoBr("Close Connection");
      	$this->m_mysqli->close();
	  	$this->m_mysqli = NULL;
    }
	
	
	/**
   	 * Drops a table 
	 * 
	 * @return bool if successful
   	 */
	public function DropTable($table) {
		if ($this->m_mysqli == NULL) {
			throw new Exception("DBConnection, must call Connect before calling Prepare");
		}
		
		
      	echoBr("Drop table");
      	$sql = "DROP TABLE  `" . $table . "`";
      
      	return $this->RunQuery($sql);
    }
	
	/**
	 * Check if a table exists
	 * @return bool 
	 */
	public function TableExists($tableName) {
		if ($this->m_mysqli == NULL) {
			throw new Exception("DBConnection, must call Connect before calling Prepare");
		}
		
	    //Create a new table with the name of the class
	    $sql = "SHOW TABLE STATUS LIKE '$tableName'";
	    
	    $result = $this->m_mysqli->query($sql);
	    
	    $row_array = $result->fetch_assoc();
	    
	    if (count($row_array) > 0) {
	      return true;
	    } else {
	      return false;
	    }
	  }
	
	/** Runs a SQL query 
	 * 
     * Note this one is sensitive to SQL-Injections and should only be used with care
	 * (no input from user or "real_eascape_string")
     * 
	 * @param string $sql a string containing an SQL-query
	 * @return bool if successful
     */
    public function RunQuery($sql) {
   	  if ($this->m_mysqli == NULL) {
		 throw new Exception("DBConnection, must call Connect before calling Prepare");
	  }
    	
      if ($this->m_mysqli->query($sql) === FALSE) {
          echoBr("'$sql' failed " . $this->m_mysqli->error);
          return false;
      }
      return true;
    }
	
	
	
	
	/** Returns all objects from a table
	 * @param string $className Name of the class contained in table
	 * @param string $tableName Name of table 
	 * @return array of objects 
	 */
	public function GetAllInstances($className, $tableName) {
		if ($this->m_mysqli == NULL) {
		 	throw new Exception("DBConnection, must call Connect before calling Prepare");
	  	}
		$sql = "SELECT * FROM " . $tableName;
		$stmt = $this->Prepare($sql);

		if ($stmt === FALSE) {
			return false;
		}
		
		return $this->RunAndFetchObjects($className, $stmt);
	}
	
	
	/**
	 * Runs a SQL query as a prepared statement and returns objects 
	 * 
	 * @param string $className Name of Class in table 
	 * @param string $sqlQueryToPrepare a string containing an SQL-query with ? for the parameters to bind
	 * @param string $bindParamTypeString String containing type-letters for the prepared statement parameters like "ss" for double string
	 * @param array $parameterArray array of parameter references to be binded to the values
	 * @return array of objects 
	 */
	public function RunPreparedSelectQuery($className, $sqlQueryToPrepare, $bindParamTypeString, $parameterArray) {
		$stmt = $this->PrepareWithParams($sqlQueryToPrepare, $bindParamTypeString, $parameterArray);
	    return $this->RunAndFetchObjects($className, $stmt);
	}
	
	/**
	 * Runs a SQL query as a prepared statement and returns true or false 
	 * 
	 * @param string $sqlQueryToPrepare a string containing an SQL-query with ? for the parameters to bind
	 * @param string $bindParamTypeString String containing type-letters for the prepared statement parameters like "ss" for double string
	 * @param array $parameterArray array of parameter REFERENCES to be binded to the values ex. array(&$a_instance->First)
	 * @return bool 
	 */
	public function RunPreparedQuery($sqlQueryToPrepare, $bindParamTypeString, $parameterArray) {
		$stmt = $this->PrepareWithParams($sqlQueryToPrepare, $bindParamTypeString, $parameterArray);
	    $ret = $stmt->execute();
		$stmt->close();
		return $ret;
	}
	
	
	/** Prepares a SQL statement
	 * 
	 * @param string $sql a string containing an SQL-query with ? for the parameters to bind
	 * @return FALSE if fail or mysqli_stmt
     */
	private function Prepare($sql) {
		if ($this->m_mysqli == NULL) {
			throw new Exception("DBConnection, must call Connect before calling Prepare");
		}
		
		$stmt = $this->m_mysqli->prepare($sql);
		if ($stmt === FALSE) {
			echoBr("prepare of '$sql' failed " . $this->m_mysqli->error);
			return FALSE;
		}
		
		return $stmt;
	}
	
	/** Takes a prepared statement and fetches all objects from it
	 * @param string $className Name of the class contained in table
	 * @return array of objects 
	 */
	private function RunAndFetchObjects($className, mysqli_stmt $stmt) {
		
		$result = $stmt->execute();
		$ret = array();
		$result = $stmt->get_result();
		
		while ($object = $result->fetch_object($className))
        {
        	//NOTE! requires that we have a pk in the object not that obvious
           	$ret[$object->pk] = $object;
        }
		
	    $stmt->close();
		
		return $ret;
	}
	/**
	 * @param string $sqlQueryToPrepare a string containing an SQL-query with ? for the parameters to bind
	 * @param array $parameterArray array of parameter REFERENCES to be binded to the values
	 * @param string $bindParamTypeString String containing type-letters for the prepared statement parameters like "ss" for double string
	 * @return mysqli_stmt
	 */
	private function PrepareWithParams($sqlQueryToPrepare, $bindParamTypeString, $parameterArray) {
		$stmt = $this->Prepare($sqlQueryToPrepare);
		
		if ($stmt === FALSE) {
			echoBr("prepare of '$sql' failed " . $this->m_mysqli->error);
			return false;
		}
		
		$parameters = array_merge(array($bindParamTypeString), $parameterArray);
		
		if (call_user_func_array(array($stmt,"bind_param"), $parameters) === FALSE) {
			echoBr("bind_param failed " . $stmt->error);
			return false;
		}
		
		return $stmt;
	}
	
}