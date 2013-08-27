<?php
    namespace Shop\View;
	
	
	class ShoppingCartView {
		
		/**
		 * Generera html för varukorgen
		 * 
		 */
		public function GetCart(\Shop\Model\OrderModel $orderModel,
								\Shop\Model\IProductHandler $productHandler) {
			$ret = "<h2>Shopping Cart 2</h2>";
			$ret .= "<ul>";
			//Hämta ut orderraderna ur modellen
			$orderLines = $orderModel->GetOrderLines();
			$total = 0;
			foreach ($orderLines as $line) {
				//hämta produkterna för att få namn, pris osv
				$product = $productHandler->GetProductById($line->m_productId);
				
				if ($product != NULL) {
					//skapa html
					$ret .= "<li>$product->m_title, $product->m_price</li>";
					$total += $product->m_price;
				}
			}
			$ret .= "</ul>";
			
			$ret .= "Total price : " . $total;
			
			
			return $ret;
		}
	}
