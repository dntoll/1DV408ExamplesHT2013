<?php


  /**
   * Landningssida för shop-exemplet
   */
  require_once("../Common/Page.php");
  require_once("../Common/PageView.php");
  
  require_once("./Model/OrderModel.php");
  require_once("./Controller/ShopMasterController.php");
  
  require_once('./settings.php');
  require_once("../Common/DBConnection.php");
  require_once("./Model/ProductHandler.php");
  require_once("./Model/ProductHandlerWithDB.php");
  
  //starta sessionen
  session_start();
  
  //skapa anslutning till databasen med hjälp utav inställningarna i ./9_shop/settings.php
  $dbconnection  = new Common\DBConnection();
  
  //Anslut till databasen
  $dbconnection->Connect();
  
  //Skapa modellklasser och ge dem tillgång till databasen
  //detta hade kunnat ske i ShopMasterController men 
  //då hade vi varit tvungna att skicka in $dbconnection, DBSettings::DBTABLEPREFIX dit istället
  $productHandler = new \Shop\Model\ProductHandlerWithDB($dbconnection, DBSettings::DBTABLEPREFIX);
  
 // $productHandler = new \Shop\Model\ProductHandler();
  
  $orderModel = new \Shop\Model\OrderModel($dbconnection, DBSettings::DBTABLEPREFIX);
  
  //The shop mastercontroller
  $masterController = new Shop\Controller\ShopMasterController($productHandler, $orderModel);
  $page = $masterController->DoControll();
  
  //stäng databasuppkopplingen
  $dbconnection->close();
  
  //Write(echo) result to user as a XHTML page 
  $view = new \Common\PageView("UTF-8");
  $view->AddStyleSheet("7.1_style.css");
  echo $view->GetXHTML10StrictPage($page->m_title, $page->m_body);
