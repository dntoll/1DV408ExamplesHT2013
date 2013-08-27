<?php
    namespace Shop\Controller;
	
	require_once("./View/ShoppingCartView.php");;
	
	
	class ShoppingCartController {
		/**
		 * Visa varukorgen
		 */
		public function DoControll(\Shop\Model\OrderModel $orderModel,
								 \Shop\Model\IProductHandler $productHandler) {
			//TODO:
			//Hantera indata
			//Gå till kassan
			//Ta bort orderrader
			
			//Genera utdata
			$scv = new \Shop\View\ShoppingCartView();
			
			
			
			$ret = new \Common\Page();
			$ret->m_body = $scv->GetCart($orderModel, $productHandler);
			return $ret;
		}
	}
