<?php
  namespace Shop\Controller;
  require_once("./View/NavigationView.php");
  require_once("./Model/IProductHandler.php");
  
  require_once("./Controller/IController.php");
  require_once("./Controller/ProductController.php");
  require_once("./Controller/ProductListController.php");
  require_once("./Controller/AddController.php");
  require_once("./Controller/ShoppingCartController.php");
  require_once("./View/PageCompositionView.php");
  
  
  /**
   * The mastercontroller of the application
   * Responsibilities
   *    Select proper controller(s) depending on input/url/session
   *    Merge output and generate page
   */
  class ShopMasterController {
    private $m_productHandler;
	private $m_orderModel;
    /** Constructor
     * @param  \Shop\Model\ProductHandler $productHandler
     */
  	public function __construct(\Shop\Model\IProductHandler $productHandler,
								\Shop\Model\OrderModel $orderModel) {
  		$this->m_productHandler = $productHandler;
		$this->m_orderModel = $orderModel;
  	}
    /**
     * Master Controller
     * 
     * @return string containing the application output as XHTML
     */
    public function DoControll() {
      //Handle "input" selected controller
      $navigationView = new \Shop\View\NavigationView();
      
      //Hantera aktiv kontroller
      $controllerOutput = $this->HandleActiveController($navigationView);
      
      //Create menu from categories
      $menuOutput = $navigationView->GetMenu($this->m_productHandler->GetCategories());
	  
	  //Skapa annons
	  $addController = new AddController();
	  $addOutput = $addController->DoControll();
	  
	  //Skapa varukorg
	  $shoppingCartController = new ShoppingCartController();
	  $shoppingCartOutput = $shoppingCartController->DoControll($this->m_orderModel, 
	  															$this->m_productHandler);
	  
	  //Let the PageCompositionView create a page for us combining output
      $pageCompositionView = new \Shop\View\PageCompositionView();
	  return $pageCompositionView->BuildPage(	$menuOutput, 
	 								 			$controllerOutput, 
	 								 			$addOutput,
									 			$shoppingCartOutput);
    }

	/**
	 * Beroende på vilken kontroller som är aktiv anropa DoControll på den
	 * 
	 * Navigationview avgör vilken kontroller som är aktiv
	 * 
	 * @return Page
	 */
	private function HandleActiveController(\Shop\View\NavigationView $navigationView) {
		$userViews = $navigationView->GetActiveControllerType();
		//Check what the user wants to view
		switch ($userViews) {
		    //User checks out a product
			case \Shop\View\NavigationView::UserViewsProducts : 
		    $activeController = new ProductController($this->m_productHandler, 
		    										  $this->m_orderModel); 
		    break;
			//User watches a list of products
			case \Shop\View\NavigationView::UserViewsCategories : 
		    $activeController = new ProductListController($this->m_productHandler); 
		    break;
			//User has not selected anything
		    default:
		        $activeController = new ProductListController($this->m_productHandler);  
		}
      
      	//Let the active controller generate output
      	//note that polymorfism can (but should not) be used without common interface, TODO make one!
      	return $activeController->DoControll($navigationView);
	}
  }



