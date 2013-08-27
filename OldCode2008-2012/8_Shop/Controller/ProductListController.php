<?php
  namespace Shop\Controller;
  
  
  /**
   * Show a list of products
   */
  class ProductListController implements IController {
  	// \Shop\Model\ProductHandler $m_productHandler
    private $m_productHandler;
	
    /**
	 * @param \Shop\View\NavigationView $navigationView
	 */
    public function __construct(\Shop\Model\IProductHandler $productHandler) {
      $this->m_productHandler = $productHandler;
    }
  
  	/**
	 * @param \Shop\View\NavigationView $navigationView
	 * @return \Page
	 */
    public function DoControll(\Shop\View\NavigationView $navigationView) {
      
      $productView = new \Shop\View\ProductView();
      
      
      //Handle Input
      $category = $navigationView->GetActiveCategory();
      
      
      //Get the right products
      if ($category == NULL) {
      	
        //no category selected show all products
        $products = $this->m_productHandler->GetAllProducts();
      } else {
        //a category selected show just products from that category
        $products = $this->m_productHandler->GetProductsByCategory($category);
      }
      
      //Generate output
      $output = $productView->GenerateProductList($products, $navigationView);
      
      $page = new \Common\Page();
	   
      $page->m_title = "Listing products";
      $page->m_body = $output;
      return $page;
    }
  }
