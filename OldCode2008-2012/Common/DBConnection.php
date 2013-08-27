<?php

	

	namespace Common;
	
	
	/**
	 * Klass som inkapslar mysqli objektet och håller reda på vår databasuppkoppling
	 */
    class DBConnection {
    	private $m_mysqli = NULL;
		
		public function Connect() {
	      $password = "";
	      $this->m_mysqli = new \mysqli(\DBSettings::DBHOST, 
	      								\DBSettings::DBUSER, 
	      								\DBSettings::DBPASSWORD,
	      								\DBSettings::DATABASE);
		  
		  //Note charset should be set before any queries...
		  $this->m_mysqli->set_charset("utf8");
	      
	      // check connection
	      if ($this->m_mysqli->connect_errno) {
	          echo "Connect failed: $this->m_mysqli->connect_error";
	          return false;
	      }
	      return true;
	    }
		
		public function Close() {
	      //stänger uppkopplingen
	      $this->m_mysqli->close();
	    }
		
		
		/**
		 * Kör prepare och hantera felmeddelanden
		 * @return mysqli_stmt
		 */
		public function Prepare($sql) {
			
			$stmt = $this->m_mysqli->prepare($sql);
			if ($stmt === FALSE) {
				//TODO: borde hanteras med en logg eller exceptions
				echo "prepare of '$sql' failed " . $this->m_mysqli->error;
				return false;
			}
			return $stmt;
		}
		
		/**
		 * @param $a_className string name of Class created... 
		 * @return array of Class instances with pk as key
		 */
		public function RunAndFetchObjects(\mysqli_stmt $a_stmt, $a_className, $a_nameOfPrimaryKey) {
			$ret = array();
			
			$a_stmt->execute();
			
			$result = $a_stmt->get_result();
			
			//hämta ut objekt av klassen '$a_className' ur resultatsettet
			while ($object = $result->fetch_object($a_className))
	        {
	        	//använd primärnyckeln för att lagra objektet i arrayen
	        	$ret[$object->$a_nameOfPrimaryKey] = $object;
	           	
	        }
			
		    $a_stmt->close();
			
			return $ret;
		}
    }
