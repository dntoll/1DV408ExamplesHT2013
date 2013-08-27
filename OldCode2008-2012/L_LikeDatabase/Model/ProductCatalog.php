<?php


namespace Model;

class ProductCatalog {
	
	
	//TODO:: skapa konstruktor som tar en databas
	
	/**
	 * @param $productId integer 
	 * @return Product or throw exception
	 */
	public function getProduct($productId, Database $db) {
		$sql = "SELECT * FROM products WHERE m_id = ?";
		$stmt = $db->Prepare($sql);
		
		
		
		$stmt->bind_param("i", $productId);
		
		
		//TODO: Detta ska ske i databasklassen för att minimera kopierad kod och se till att felhantering fungerar 
		$stmt->execute();
		
		//Bind the $ret parameter so when we call fetch it gets its value
		//http://php.net/manual/en/mysqli-stmt.bind-result.php
		if ($stmt->bind_result($id, $title, $description) == FALSE) {
			throw new \Exception($this->mysqli->error);
		}
		
	     if ($stmt->fetch()) {
	        $ret = new Product($id, $title, $description);
			
	     } else {
	     	throw new \Exception("Could not find a product with id $productId");
	     }
		
		$stmt->close();
		
		
		return $ret;
	}
	/**
	 * @return ProductArray
	 */
	public function getAllProducts(Database $db) {
		//Select from database
		
		$sql = "SELECT * FROM products";
		$stmt = $db->Select($sql);
		
		//Bind the $ret parameter so when we call fetch it gets its value
		//http://php.net/manual/en/mysqli-stmt.bind-result.php
		if ($stmt->bind_result($id, $title, $description) == FALSE) {
			throw new \Exception($this->mysqli->error);
		}

	    $ret = new ProductArray();
	     while ($stmt->fetch()) {
	        $product = new Product($id, $title, $description);
			$ret->add($product);
	     }
		
		$stmt->close();
		
		
		return $ret;
	}
	
	
	public static function test(Database $db) {
		$sut = new ProductCatalog();
			
		$allProducts = $sut->getAllProducts($db);
		
		if (get_class($allProducts) != "Model\ProductArray") {
			echo "ProductCatalog->getAllProducts() returned a " . get_class($allProducts);
			return false;
		}
		
		 if (count($allProducts->get()) != 3) {
		 	echo "ProductCatalog->getAllProducts() returned wrong number of products";
		 	
		 	var_dump($allProducts->get());
			return false;
		 }
		
		
		
		
		foreach ($allProducts->get() as $product) {
			
			
			
			$actual = $sut->getProduct($product->getId(), $db);
			
			if ($actual->getTitle() != $product->getTitle()) {
				echo "ProductCatalog->getProduct differs in return value from getAllProducts";
				return false;
			}
			
			if ($actual->getDescription() != $product->getDescription()) {
				echo "ProductCatalog->getProduct differs in return value from getAllProducts";
				return false;
			}
			
			if ($actual->getId() != $product->getId()) {
				echo "ProductCatalog->getProduct differs in return value from getAllProducts";
				return false;
			}
			
		}
		
		return true;
	}
}
