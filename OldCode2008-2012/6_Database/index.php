<?php

  require_once("echoBr.php");
  require_once("DatabaseAccess.php");
  
  class DatabaseAccessExample {
    
    
    public function run() {
      
      $dbaccess = new DatabaseAccess(); 
      
      if ($dbaccess->Connect("localhost", "root", "", "test_db") == false) {
        return;
      }
      $dbaccess->CreateTables();
      $dbaccess->InsertRows();
      $dbaccess->SelectAll();
      $dbaccess->RemoveTables();
      $dbaccess->Close();
    }
  }

/*
 * Note that there is no html view this time... maybe something to fix!
 */
$instance = new DatabaseAccessExample();
$instance->run();
  
