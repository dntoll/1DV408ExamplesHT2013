<?php

namespace Controller;

class ProductListController {
	
	public function doControll(\Model\Database $db, \Model\ProductCatalog $productCatalog) {
		$pv = new \View\ProductView();
		
		$products = $productCatalog->getAllProducts($db);
		
		$ret = $pv->showListOfProducts($products);
		return $ret;
	}
}
