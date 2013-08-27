<?php

namespace Controller;

session_start();


//TODO: Städa filer
//TODO: Skapa namespaces

require_once('Controller/LikeController.php');
require_once('..\Common\PageView.php');
require_once('Model/DBConfig.php');
require_once('Model/Database.php');
require_once('Model/Product.php');
require_once('Model/ProductCatalog.php');

require_once('View/OtherLikeView.php');
require_once('View/LikeView.php');
require_once('Controller/ProductController.php');
require_once('Controller/ProductListController.php');
require_once('View/PageCompositionView.php');
require_once('View/NavigationView.php');
require_once('View/ProductView.php');

//TODO: Flytta till mappen Controller


/**
 * The MC represents the entire application
 */
class MasterController {
	
	/**
	 * @return String HTML document
	 */
	public static function doControll() {
		//Create and initialize database
		$db = new \Model\Database();
		$db->Connect(new \Model\DBConfig());
		
		$navView = new \View\NavigationView();
		$pcv = new \View\PageCompositionView();
		
		
		if ($navView->isViewingProduct()) {
			$productCatalog = new \Model\ProductCatalog();
			$productController = new \Controller\ProductController();
			$pco = $productController->doControll($db, $productCatalog);
			//kombinera utdata från flera controllers via en vy!
			$html = $pcv->merge($pco->m_productHtml, 
								$pco->m_likeHtml);
		} else {
			$productListController = new \Controller\ProductListController();
			$html = $productListController->doControll($db);
				
		}
		
		//Close the database since it is no longer used
		$db->Close();

		//Generate output
		$pageView = new \Common\PageView();
		return $pageView->GetHTMLPage("I like titles", $html);
	}
	
}

echo MasterController::doControll();




 
