<?php
  namespace Shop\Controller;
  
  require_once("./View/ProductView.php");
  
  
  /**
   * Controller that handles the view product scenario
   * 
   * Show all information about a selected product
   */
  class ProductController implements IController  {
    
	
    private $m_productHandler; //\Shop\Model\IProductHandler
	private $m_orderModel; //\Shop\Model\OrderModel 
    
    
    public function __construct(\Shop\Model\IProductHandler $productHandler, 
    							\Shop\Model\OrderModel $orderModel) {
      $this->m_productHandler = $productHandler;
	  $this->m_orderModel = $orderModel;
    }
  
  	
    public function DoControll(\Shop\View\NavigationView $navigationView) {
      //Create views
      $productView = new \Shop\View\ProductView();
      
      //Get input
      $productId = $navigationView->GetSelectedProductId();
      
      //Collect the selected product from the model
      $selectedProduct = $this->m_productHandler->GetProductById($productId);
      
	  
	  
      
      //Make sure the product exists
      if ($selectedProduct !== NULL) {
      	
    		//Add buy behaviour
    		if ($navigationView->DidUserBuyProduct($selectedProduct)) {
    			//Hantera köpet
    			$this->m_orderModel->BuyProduct($selectedProduct);
    			$navigationView->Relocate($selectedProduct);
    		}
    		//Generera produktsida för den valda produkten
          $page = $productView->GetProductPage($selectedProduct, $navigationView);
        } else {
        	//Generera felmeddelande eftersom produkten inte existerar
          $page = $productView->ProductNotFoundPage($productId);
        }
      
      
      
        return $page;
      }
  }
