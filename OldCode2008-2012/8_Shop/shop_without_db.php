<?php
  
  require_once("../Common/Page.php");
  require_once("../Common/PageView.php");
  require_once("./Model/OrderModel.php");
  require_once("./Model/ProductHandler.php");
  require_once("../Common/DBConnection.php");
  require_once("./Controller/ShopMasterController.php");
  require_once('./settings.php');
  
  session_start();
  
  $dbconnection  = new \Common\DBConnection();
  $dbconnection->Connect();
  
  
  //Create product model 
  $productHandler = new \Shop\Model\ProductHandler();
  $orderModel = new \Shop\Model\OrderModel($dbconnection,"shop_");
  
  
  //The shop mastercontroller
  $masterController = new Shop\Controller\ShopMasterController($productHandler, $orderModel);
  $page = $masterController->DoControll();
  
  $dbconnection->Close();
  //Write(echo) result to user as a XHTML page 
  $view = new \Common\PageView("UTF-8");
  $view->AddStyleSheet("7.1_style.css");
  
  
  echo $view->GetXHTML10StrictPage($page->m_title, "<h1>Shop utan ProductHandler DB </h1> " . $page->m_body);
